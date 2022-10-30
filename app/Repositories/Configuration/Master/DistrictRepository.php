<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\District;
use App\Repositories\Configuration\Master\DivisionRepository;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class DistrictRepository {

	protected $district;
	protected $division;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		DivisionRepository $division,
		District $district
	) {
		$this->district = $district;
		$this->division = $division;
	}

	public function model() {
		return District::class;
	}

	private function route() {
		return 'admin.configuration.master.district.';
	}

	private function permission() {
		return '-district';
	}

	/**
	 * Get district query
	 *
	 * @return District query
	 */
	public function getQuery() {
		return $this->district;
	}

	/**
	 * Count district
	 *
	 * @return integer
	 */
	public function count() {
		return $this->district->count();
	}

	/**
	 * List all district by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->district->all()->pluck('name', 'id')->prepend(_lang('Select District'), '');
	}

	/**
	 * List all district by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->district->all(['name', 'id']);
	}

	/**
	 * List all district by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->district->all()->pluck('id')->all();
	}

	/**
	 * Get all district
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->district->all();
	}

	/**
	 * Find district with given id.
	 *
	 * @param integer $id
	 * @return District
	 */
	public function find($id) {
		return $this->district->find($id)->with(['division']);
	}

	/**
	 * Find district with given id or throw an error.
	 *
	 * @param integer $id
	 * @return District
	 */
	public function findOrFail($id, $field = 'message') {
		$district = $this->district->with(['division'])->find($id);
		if (!$district) {
			throw ValidationException::withMessages([$field => _lang('District Not Found.')]);
		}
		return $district;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return District
	 */
	public function getData($params) {
		$division = gv($params, 'division');
		$query = $this->district->with('division')->where('division_id', $division)
			->get();
		return $query;
	}

	/**
	 * Pre Requisite For division using given params.
	 *
	 * @param array $params
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function preRequisite() {
		$divisions = $this->division->listAll();
		//dd($divisions);
		return compact('divisions');
	}

	/**
	 * Get all preReuisite
	 *
	 * @param array $params
	 * @return Division
	 */
	public function preReuisiteSelectForm($params) {
		$data['name'] = gv($params, 'name');
		$data['division'] = gv($params, 'division');
		$data['form_id'] = gv($params, 'form_id');
		$divisions = $this->division->getQuery()->where('id', $data['division'])->pluck('name', 'id')->prepend(trans('select.division'), '');
		return compact('data', 'divisions');
	}

	/**
	 * Get all data for Index
	 */
	public function datatable() {
		$models = $this->getAll();
		return Datatables::of($models)
			->addIndexColumn()
			->addColumn('division', function ($model) {
				return $model->division ? '<strong>' . $model->division->name . '</strong>' : '';
			})
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
			->rawColumns(['action', 'name', 'division'])
			->make(true);
	}

	/**
	 * Get all filtered data for printing
	 *
	 * @param array $params
	 * @return District
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new district.
	 *
	 * @param array $params
	 * @return District
	 */
	public function create($params) {
		return $this->district->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $division_id
	 * @return array
	 */
	private function formatParams($params, $district_id = null) {
		$formatted = [
			'division_id' => gv($params['division'], 'id'),
			'name' => gv($params, 'name'),
		];
		$formatted['options'] = [];
		return $formatted;
	}

	/**
	 * Update given district.
	 *
	 * @param District $district
	 * @param array $params
	 *
	 * @return District
	 */
	public function update(District $district, $params) {
		return $district->forceFill($this->formatParams($params, $district->id))->save();
	}

	/**
	 * Find district & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return District
	 */
	public function deletable($id) {
		$district = $this->findOrFail($id);
		if ($district->upozilas()->count()) {
			throw ValidationException::withMessages(['message' => _lang('District Associated With Upozilas.')]);
		}
		return $district;
	}

	/**
	 * Delete district.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(District $district) {
		return $district->delete();
	}

	/**
	 * Delete multiple district.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function deleteMultiple($ids) {
		return $this->district->whereIn('id', $ids)->delete();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'Districts Deleted Successfull';
		}
	}
}