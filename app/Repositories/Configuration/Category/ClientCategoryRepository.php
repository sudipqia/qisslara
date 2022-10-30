<?php

namespace App\Repositories\Configuration\Category;

use App\Models\Configuration\Category\ClientCategory;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class ClientCategoryRepository {

	protected $client;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		ClientCategory $client
	) {
		$this->client = $client;
	}

	public function model() {
		return ClientCategory::class;
	}

	private function route() {
		return 'admin.configuration.category.client.';
	}

	private function permission() {
		return '-client';
	}

	/**
	 * Get client query
	 *
	 * @return ClientCategory query
	 */
	public function getQuery() {
		return $this->client;
	}

	/**
	 * Count client
	 *
	 * @return integer
	 */
	public function count() {
		return $this->client->count();
	}

	/**
	 * List all client by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->client->all()->pluck('name', 'id')->prepend(_lang('select_client_category'), '');
	}

	/**
	 * List all client by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->client->all(['name', 'id']);
	}

	/**
	 * List all client by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->client->all()->pluck('id')->all();
	}

	/**
	 * Get all client
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->client->all();
	}

	/**
	 * Find client with given id.
	 *
	 * @param integer $id
	 * @return ClientCategory
	 */
	public function find($id) {
		return $this->client->find($id);
	}

	/**
	 * Find client with given id or throw an error.
	 *
	 * @param integer $id
	 * @return ClientCategory
	 */
	public function findOrFail($id, $field = 'message') {
		$client = $this->client->find($id);
		if (!$client) {
			throw ValidationException::withMessages([$field => _lang('client_category_not_found')]);
		}
		return $client;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return ClientCategory
	 */
	public function getData($params) {
		$query = $this->client->where('name', 'LIKE', '%' . $params . '%')
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
	 * @return ClientCategory
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new client.
	 *
	 * @param array $params
	 * @return ClientCategory
	 */
	public function create($params) {
		return $this->client->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $client_id
	 * @return array
	 */
	private function formatParams($params, $client_id = null) {
		$formatted = [
			'name' => gv($params, 'name'),
			'description' => gv($params, 'description'),
			'status' => gbv($params, 'status'),
		];
		return $formatted;
	}

	/**
	 * Update given client.
	 *
	 * @param ClientCategory $client
	 * @param array $params
	 *
	 * @return ClientCategory
	 */
	public function update(ClientCategory $client, $params) {
		return $client->forceFill($this->formatParams($params, $client->id))->save();
	}

	/**
	 * Find client & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return ClientCategory
	 */
	public function deletable($id) {
		$client = $this->findOrFail($id);
		// if ($client->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('client_category_associate')]);
		// }
		return $client;
	}

	/**
	 * Delete client.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(ClientCategory $client) {
		return $client->delete();
	}

	/**
	 * Delete multiple client.
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
	 * Online multiple client.
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
	 * Online multiple client.
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
	 * Online multiple client.
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

	public function updateStatus(ClientCategory $client) {
		$client->status = !$client->status;
		return $client->save();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'client_categories_delete';
		} else if ($data['action'] == 'online') {
			$this->onlineMultiple($data['ids']);
			return 'client_categories_online';
		} else if ($data['action'] == 'offline') {
			$this->offlineMultiple($data['ids']);
			return 'client_categories_offline';
		} else if ($data['action'] == 'toggle') {
			$this->toggleMultiple($data['ids']);
			return 'client_categories_toggl';
		}
	}
}