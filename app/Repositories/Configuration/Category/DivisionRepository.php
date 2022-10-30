<?php

namespace App\Repositories\Configuration\Category;

use App\Models\Configuration\Category\CaseCategory;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class CaseCategoryRepository {

	protected $case;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		CaseCategory $case
	) {
		$this->case = $case;
	}

	public function model() {
		return CaseCategory::class;
	}

	private function route() {
		return 'admin.configuration.categroy.case.';
	}

	private function permission() {
		return '-case';
	}

	/**
	 * Get case query
	 *
	 * @return CaseCategory query
	 */
	public function getQuery() {
		return $this->case;
	}

	/**
	 * Count case
	 *
	 * @return integer
	 */
	public function count() {
		return $this->case->count();
	}

	/**
	 * List all case by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->case->all()->pluck('name', 'id')->prepend(_lang('select_case_category'), '');
	}

	/**
	 * List all case by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->case->all(['name', 'id']);
	}

	/**
	 * List all case by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->case->all()->pluck('id')->all();
	}

	/**
	 * Get all case
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->case->all();
	}

	/**
	 * Find case with given id.
	 *
	 * @param integer $id
	 * @return CaseCategory
	 */
	public function find($id) {
		return $this->case->find($id);
	}

	/**
	 * Find case with given id or throw an error.
	 *
	 * @param integer $id
	 * @return CaseCategory
	 */
	public function findOrFail($id, $field = 'message') {
		$case = $this->case->with('districts')->find($id);
		if (!$case) {
			throw ValidationException::withMessages([$field => _lang('case_category_not_found')]);
		}
		return $case;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return CaseCategory
	 */
	public function getData($params) {
		$query = $this->case->where('name', 'LIKE', '%' . $params . '%')
			->orWhere('sortname', 'LIKE', '%' . $params . '%')->orWhere('phonecode', 'LIKE', '%' . $params . '%')->get();
		return $query;
	}

	/**
	 * Get all preReuisite
	 *
	 * @param array $params
	 * @return CaseCategory
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
	 * @return CaseCategory
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new case.
	 *
	 * @param array $params
	 * @return CaseCategory
	 */
	public function create($params) {
		return $this->case->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $case_id
	 * @return array
	 */
	private function formatParams($params, $case_id = null) {
		$formatted = [
			'sortname' => gv($params, 'sortname'),
			'name' => gv($params, 'name'),
			'phonecode' => gv($params, 'phonecode'),
		];
		$formatted['options'] = [];
		return $formatted;
	}

	/**
	 * Update given case.
	 *
	 * @param CaseCategory $case
	 * @param array $params
	 *
	 * @return CaseCategory
	 */
	public function update(CaseCategory $case, $params) {
		return $case->forceFill($this->formatParams($params, $case->id))->save();
	}

	/**
	 * Find case & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return CaseCategory
	 */
	public function deletable($id) {
		$case = $this->findOrFail($id);
		if ($case->districts()->count()) {
			throw ValidationException::withMessages(['message' => _lang('case_category_associate')]);
		}
		return $case;
	}

	/**
	 * Delete case.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(CaseCategory $case) {
		return $case->delete();
	}

	/**
	 * Delete multiple case.
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
			return 'case_categories_delete';
		}
	}
}