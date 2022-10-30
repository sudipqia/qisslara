<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\Act;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class ActRepository {

	protected $act;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		Act $act
	) {
		$this->act = $act;
	}

	public function model() {
		return Act::class;
	}

	private function route() {
		return 'admin.configuration.master.act.';
	}

	private function permission() {
		return '-act';
	}

	/**
	 * Get act query
	 *
	 * @return Act query
	 */
	public function getQuery() {
		return $this->act;
	}

	/**
	 * Count act
	 *
	 * @return integer
	 */
	public function count() {
		return $this->act->count();
	}

	/**
	 * List all act by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->act->all()->pluck('name', 'id')->prepend(_lang('Select Act'), '');
	}

	/**
	 * List all act by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->act->all(['name', 'id']);
	}

	/**
	 * List all act by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->act->all()->pluck('id')->all();
	}

	/**
	 * Get all act
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->act->all();
	}

	/**
	 * Find act with given id.
	 *
	 * @param integer $id
	 * @return Act
	 */
	public function find($id) {
		return $this->act->find($id);
	}

	/**
	 * Find act with given id or throw an error.
	 *
	 * @param integer $id
	 * @return Act
	 */
	public function findOrFail($id, $field = 'message') {
		$act = $this->act->find($id);
		if (!$act) {
			throw ValidationException::withMessages([$field => _lang('Act Not Found')]);
		}
		return $act;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return Act
	 */
	public function getData($params) {
		$query = $this->act->where('name', 'LIKE', '%' . $params . '%')
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
	 * @return Act
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new act.
	 *
	 * @param array $params
	 * @return Act
	 */
	public function create($params) {
		return $this->act->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $act_id
	 * @return array
	 */
	private function formatParams($params, $act_id = null) {
		$formatted = [
			'name' => gv($params, 'name'),
			'act_no' => gv($params, 'act_no'),
			'description' => gv($params, 'description'),
			'status' => gbv($params, 'status'),
		];
		return $formatted;
	}

	/**
	 * Update given act.
	 *
	 * @param Act $act
	 * @param array $params
	 *
	 * @return Act
	 */
	public function update(Act $act, $params) {
		return $act->forceFill($this->formatParams($params, $act->id))->save();
	}

	/**
	 * Find act_id & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return Act
	 */
	public function deletable($id) {
		$act = $this->findOrFail($id);
		// if ($act->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('case_stage_master_associate')]);
		// }
		return $act;
	}

	/**
	 * Delete act.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(Act $act) {
		return $act->delete();
	}

	/**
	 * Delete multiple act.
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
	 * Online multiple act.
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
	 * Online multiple act.
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
	 * Online multiple act.
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

	public function updateStatus(Act $act) {
		$act->status = !$act->status;
		return $act->save();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'Acts delete';
		} else if ($data['action'] == 'online') {
			$this->onlineMultiple($data['ids']);
			return 'Acts online';
		} else if ($data['action'] == 'offline') {
			$this->offlineMultiple($data['ids']);
			return 'Acts offline';
		} else if ($data['action'] == 'toggle') {
			$this->toggleMultiple($data['ids']);
			return 'Acts toggle';
		}
	}
}