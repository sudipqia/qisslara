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
		return 'admin.configuration.category.case.';
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
		$case = $this->case->find($id);
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
			->orWhere('name', 'LIKE', '%' . $params . '%')->orWhere('description', 'LIKE', '%' . $params . '%')->get();
		return $query;
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
			->editColumn('description', function ($model) {
				return $model->description;
			})
			->addColumn('action', function ($model) {
				$route = $this->route();
				$permission = $this->permission();
				return view('action', compact('model', 'route', 'permission'));
			})
			->addColumn('status', function ($model) {
				$route = $this->route();
				return view('status', compact('model', 'route'));
			})
			->removeColumn('created_at')
			->removeColumn('updated_at')
			->rawColumns(['action', 'name', 'status', 'description'])
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
			'name' => gv($params, 'name'),
			'description' => gv($params, 'description'),
			'status' => gbv($params, 'status'),
		];
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
			if ($case->case()->count()) {
			throw ValidationException::withMessages(['message' => _lang($model->account_name.' '.'Case Category Associate')]);
		     }
		// if ($case->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('case_category_associate')]);
		// }
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

	/**
	 * Online multiple case.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function onlineMultiple($ids) {
		foreach ($ids as $id) {
			$model = $this->findOrFail($id);
			$model->status = 1;
			$model->save();
		}
		return true;
	}

	/**
	 * Online multiple case.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function offlineMultiple($ids) {
		foreach ($ids as $id) {
			$model = $this->findOrFail($id);
			$model->status = 0;
			$model->save();
		}
		return true;
	}

	/**
	 * Online multiple case.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function toggleMultiple($ids) {
		foreach ($ids as $id) {
			$model = $this->findOrFail($id);
			$model->status = !$model->status;
			$model->save();
		}
		return true;
	}

	public function updateStatus(CaseCategory $case) {
		$case->status = !$case->status;
		return $case->save();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'case_categories_delete';
		} else if ($data['action'] == 'online') {
			$this->onlineMultiple($data['ids']);
			return 'case_categories_online';
		} else if ($data['action'] == 'offline') {
			$this->offlineMultiple($data['ids']);
			return 'case_categories_offline';
		} else if ($data['action'] == 'toggle') {
			$this->toggleMultiple($data['ids']);
			return 'case_categories_toggle';
		}
	}
}