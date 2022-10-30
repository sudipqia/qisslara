<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\Division;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class DivisionRepository {

	protected $division;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		Division $division
	) {
		$this->division = $division;
	}

	public function model() {
		return Division::class;
	}

	private function route() {
		return 'admin.configuration.master.division.';
	}

	private function permission() {
		return '-division';
	}

	/**
	 * Get division query
	 *
	 * @return Division query
	 */
	public function getQuery() {
		return $this->division;
	}

	/**
	 * Count division
	 *
	 * @return integer
	 */
	public function count() {
		return $this->division->count();
	}

	/**
	 * List all division by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->division->all()->pluck('name', 'id')->prepend(_lang('Select Division'), '');
	}

	/**
	 * List all division by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->division->all(['name', 'id']);
	}

	/**
	 * List all division by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->division->all()->pluck('id')->all();
	}

	/**
	 * Get all division
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->division->all();
	}

	/**
	 * Find division with given id.
	 *
	 * @param integer $id
	 * @return Division
	 */
	public function find($id) {
		return $this->division->find($id);
	}

	/**
	 * Find division with given id or throw an error.
	 *
	 * @param integer $id
	 * @return Division
	 */
	public function findOrFail($id, $field = 'message') {
		$division = $this->division->with('districts')->find($id);
		if (!$division) {
			throw ValidationException::withMessages([$field => _lang('Division Not Found.')]);
		}
		return $division;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return Division
	 */
	public function getData($params) {
		$query = $this->division->where('name', 'LIKE', '%' . $params . '%')
			->orWhere('sortname', 'LIKE', '%' . $params . '%')->orWhere('phonecode', 'LIKE', '%' . $params . '%')->get();
		return $query;
	}

	/**
	 * Get all preReuisite
	 *
	 * @param array $params
	 * @return Division
	 */
	public function preReuisiteSelectForm($params) {
		$data['name'] = gv($params, 'name');
		$data['form_id'] = gv($params, 'form_id');
		return compact('data');
	}

	/**
	 * Get all data for Index
	 */
	public function datatable() {
		$models = $this->getAll();
		return Datatables::of($models)
			->addIndexColumn()
			->editColumn('name', function ($model) {
				return '<strong>' . $model->name . '</strong>';
			})
			->addColumn('action', function ($model) {
				$route = $this->route();
				$permission = $this->permission();
				return view('action', compact('model', 'route', 'permission'));
			})
			->removeColumn('created_at')
			->removeColumn('updated_at')
			->rawColumns(['action', 'name'])
			->make(true);
	}

	/**
	 * Get all filtered data for printing
	 *
	 * @param array $params
	 * @return Division
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new division.
	 *
	 * @param array $params
	 * @return Division
	 */
	public function create($params) {
		return $this->division->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $division_id
	 * @return array
	 */
	private function formatParams($params, $division_id = null) {
		$formatted = [
			'sortname' => gv($params, 'sortname'),
			'name' => gv($params, 'name'),
			'phonecode' => gv($params, 'phonecode'),
		];
		$formatted['options'] = [];
		return $formatted;
	}

	/**
	 * Update given division.
	 *
	 * @param Division $division
	 * @param array $params
	 *
	 * @return Division
	 */
	public function update(Division $division, $params) {
		return $division->forceFill($this->formatParams($params, $division->id))->save();
	}

	/**
	 * Find division & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return Division
	 */
	public function deletable($id) {
		$division = $this->findOrFail($id);
		if ($division->districts()->count()) {
			throw ValidationException::withMessages(['message' => _lang('Division Associated With Districts.')]);
		}
		return $division;
	}

	/**
	 * Delete division.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(Division $division) {
		return $division->delete();
	}

	/**
	 * Delete multiple division.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function deleteMultiple($ids) {
		foreach ($ids as $id) {
			$model = $this->deletable($id);
			$model = $this->findOrFail($id)->delete();
		}
		return true;
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'Divisions Deleted Successfull';
		}
	}
}