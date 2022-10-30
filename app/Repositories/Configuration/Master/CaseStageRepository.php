<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\CaseStage;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class CaseStageRepository {

	protected $case_stage;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		CaseStage $case_stage
	) {
		$this->case_stage = $case_stage;
	}

	public function model() {
		return CaseStage::class;
	}

	private function route() {
		return 'admin.configuration.master.case_stage.';
	}

	private function permission() {
		return '-case_stage';
	}

	/**
	 * Get case_stage query
	 *
	 * @return CaseStage query
	 */
	public function getQuery() {
		return $this->case_stage;
	}

	/**
	 * Count case_stage
	 *
	 * @return integer
	 */
	public function count() {
		return $this->case_stage->count();
	}

	/**
	 * List all case_stage by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->case_stage->all()->pluck('name', 'id')->prepend(_lang('select_case_stage_master'), '');
	}

	/**
	 * List all case_stage by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->case_stage->all(['name', 'id']);
	}

	/**
	 * List all case_stage by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->case_stage->all()->pluck('id')->all();
	}

	/**
	 * Get all case_stage
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->case_stage->all();
	}

	/**
	 * Find case_stage with given id.
	 *
	 * @param integer $id
	 * @return CaseStage
	 */
	public function find($id) {
		return $this->case_stage->find($id);
	}

	/**
	 * Find case_stage with given id or throw an error.
	 *
	 * @param integer $id
	 * @return CaseStage
	 */
	public function findOrFail($id, $field = 'message') {
		$case_stage = $this->case_stage->find($id);
		if (!$case_stage) {
			throw ValidationException::withMessages([$field => _lang('case_stage_master_not_found')]);
		}
		return $case_stage;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return CaseStage
	 */
	public function getData($params) {
		$query = $this->case_stage->where('name', 'LIKE', '%' . $params . '%')
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
	 * @return CaseStage
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new case_stage.
	 *
	 * @param array $params
	 * @return CaseStage
	 */
	public function create($params) {
		return $this->case_stage->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $case_stage_id
	 * @return array
	 */
	private function formatParams($params, $case_stage_id = null) {
		$formatted = [
			'name' => gv($params, 'name'),
			'description' => gv($params, 'description'),
			'status' => gbv($params, 'status'),
		];
		return $formatted;
	}

	/**
	 * Update given case_stage.
	 *
	 * @param CaseStage $case_stage
	 * @param array $params
	 *
	 * @return CaseStage
	 */
	public function update(CaseStage $case_stage, $params) {
		return $case_stage->forceFill($this->formatParams($params, $case_stage->id))->save();
	}

	/**
	 * Find case_stage & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return CaseStage
	 */
	public function deletable($id) {
		$case_stage = $this->findOrFail($id);
		// if ($case_stage->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('case_stage_master_associate')]);
		// }
		return $case_stage;
	}

	/**
	 * Delete case_stage.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(CaseStage $case_stage) {
		return $case_stage->delete();
	}

	/**
	 * Delete multiple case_stage.
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
	 * Online multiple case_stage.
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
	 * Online multiple case_stage.
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
	 * Online multiple case_stage.
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

	public function updateStatus(CaseStage $case_stage) {
		$case_stage->status = !$case_stage->status;
		return $case_stage->save();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'case_stage_categories_delete';
		} else if ($data['action'] == 'online') {
			$this->onlineMultiple($data['ids']);
			return 'case_stage_categories_online';
		} else if ($data['action'] == 'offline') {
			$this->offlineMultiple($data['ids']);
			return 'case_stage_categories_offline';
		} else if ($data['action'] == 'toggle') {
			$this->toggleMultiple($data['ids']);
			return 'case_stage_categories_toggle';
		}
	}
}