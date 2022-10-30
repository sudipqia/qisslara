<?php

namespace App\Repositories\Configuration\Category;

use App\Models\Configuration\Category\CourtCategory;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class CourtCategoryRepository {

	protected $court;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		CourtCategory $court
	) {
		$this->court = $court;
	}

	public function model() {
		return CourtCategory::class;
	}

	private function route() {
		return 'admin.configuration.category.court.';
	}

	private function permission() {
		return '-court';
	}

	/**
	 * Get court query
	 *
	 * @return CourtCategory query
	 */
	public function getQuery() {
		return $this->court;
	}

	/**
	 * Count court
	 *
	 * @return integer
	 */
	public function count() {
		return $this->court->count();
	}

	/**
	 * List all court by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->court->all()->pluck('name', 'id')->prepend(_lang('select_court_category'), '');
	}

	/**
	 * List all court by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->court->all(['name', 'id']);
	}

	/**
	 * List all court by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->court->all()->pluck('id')->all();
	}

	/**
	 * Get all court
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->court->all();
	}

	/**
	 * Find court with given id.
	 *
	 * @param integer $id
	 * @return CourtCategory
	 */
	public function find($id) {
		return $this->court->find($id);
	}

	/**
	 * Find court with given id or throw an error.
	 *
	 * @param integer $id
	 * @return CourtCategory
	 */
	public function findOrFail($id, $field = 'message') {
		$court = $this->court->find($id);
		if (!$court) {
			throw ValidationException::withMessages([$field => _lang('court_category_not_found')]);
		}
		return $court;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return CourtCategory
	 */
	public function getData($params) {
		$query = $this->court->where('name', 'LIKE', '%' . $params . '%')
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
	 * @return CourtCategory
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new court.
	 *
	 * @param array $params
	 * @return CourtCategory
	 */
	public function create($params) {
		return $this->court->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $court_id
	 * @return array
	 */
	private function formatParams($params, $court_id = null) {
		$formatted = [
			'name' => gv($params, 'name'),
			'description' => gv($params, 'description'),
			'status' => gbv($params, 'status'),
		];
		return $formatted;
	}

	/**
	 * Update given court.
	 *
	 * @param CourtCategory $court
	 * @param array $params
	 *
	 * @return CourtCategory
	 */
	public function update(CourtCategory $court, $params) {
		return $court->forceFill($this->formatParams($params, $court->id))->save();
	}

	/**
	 * Find court & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return CourtCategory
	 */
	public function deletable($id) {
		$court = $this->findOrFail($id);
		// if ($court->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('court_category_associate')]);
		// }
		return $court;
	}

	/**
	 * Delete court.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(CourtCategory $court) {
		return $court->delete();
	}

	/**
	 * Delete multiple court.
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
	 * Online multiple court.
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
	 * Online multiple court.
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
	 * Online multiple court.
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

	public function updateStatus(CourtCategory $court) {
		$court->status = !$court->status;
		return $court->save();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'court_categories_delete';
		} else if ($data['action'] == 'online') {
			$this->onlineMultiple($data['ids']);
			return 'court_categories_online';
		} else if ($data['action'] == 'offline') {
			$this->offlineMultiple($data['ids']);
			return 'court_categories_offline';
		} else if ($data['action'] == 'toggle') {
			$this->toggleMultiple($data['ids']);
			return 'court_categories_toggl';
		}
	}
}