<?php

namespace App\Repositories\Client;

use App\Models\Client;
use App\Repositories\Configuration\Master\DistrictRepository;
use App\Repositories\Configuration\Master\DivisionRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class ClientRepository {

	protected $client;
	protected $division;
	protected $district;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		Client $client,
		DistrictRepository $district,
		DivisionRepository $division
	) {
		$this->client = $client;
		$this->district = $district;
		$this->division = $division;
	}

	public function model() {
		return Client::class;
	}

	private function route() {
		return 'admin.client.';
	}

	private function permission() {
		return '-client';
	}

	/**
	 * Get client query
	 *
	 * @return Client query
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
		return $this->client->all()->pluck('name', 'id')->prepend(_lang('select_court_master'), '');
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
	 * @return Client
	 */
	public function find($id) {
		return $this->client->find($id);
	}

	public function preRequisite($id = Null) {
		$divisions = $this->division->listAll();
		$compact = compact('divisions');
		if ($id) {
			$client = $this->find($id);
			$districts = $this->district->getQuery()->where('division_id', $client->division_id)->pluck('name', 'id')->prepend(_lang('Select District'), '');
			$compact = compact('divisions', 'districts');
		}

		//dd($divisions);
		return $compact;
	}

	/**
	 * Find client with given id or throw an error.
	 *
	 * @param integer $id
	 * @return Client
	 */
	public function findOrFail($id, $field = 'message') {
		$client = $this->client->find($id);
		if (!$client) {
			throw ValidationException::withMessages([$field => _lang('court_master_not_found')]);
		}
		return $client;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return Client
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
			->editColumn('division', function ($model) {
				return $model->division ? $model->division->name : '';
			})
			->editColumn('district', function ($model) {
				return $model->district ? $model->district->name : '';
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
			->rawColumns(['action', 'name', 'status'])
			->make(true);
	}

	/**
	 * Get all filtered data for printing
	 *
	 * @param array $params
	 * @return Client
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new client.
	 *
	 * @param array $params
	 * @return Client
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
		if ($client_id) {
			$client = $this->findOrFail($client_id);
			$file_exit = $client->file;
			if ($file_exit && gv($params, 'file')) {
				Storage::delete('public/client/file/' . $file_exit);
				$file = $this->file(gv($params, 'file'));
			} elseif ($file_exit) {
				$file = $file_exit;
			} else {
				$file = $this->file(gv($params, 'file'));
			}

		} else {
			$file = $this->file(gv($params, 'file'));
		}
		$formatted = [
			'name' => gv($params, 'name'),
			'division_id' => gv(gv($params, 'division'), 'id'),
			'district_id' => gv(gv($params, 'district'), 'id'),
			'mobile' => gv($params, 'mobile'),
			'email' => gv($params, 'email'),
			'address' => gv($params, 'address'),
			'gender' => gv($params, 'gender'),
			'file' => $file,
			'status' => gbv($params, 'status'),
		];
		return $formatted;
	}

	private function file($params) {
		if ($params) {
			$storagepath = $params->store('public/client/file');
			$fileName = basename($storagepath);
			return $fileName;

		}
	}

	/**
	 * Update given client.
	 *
	 * @param Client $client
	 * @param array $params
	 *
	 * @return Client
	 */
	public function update(Client $client, $params) {
		return $client->forceFill($this->formatParams($params, $client->id))->save();
	}

	/**
	 * Find client & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return Client
	 */
	public function deletable($id) {
		$client = $this->findOrFail($id);
		// if ($client->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('court_master_associate')]);
		// }
		return $client;
	}

	/**
	 * Delete client.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(Client $client) {
		$file_exit = $client->file;
		if ($file_exit) {
			Storage::delete('public/client/file/' . $file_exit);
		}
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

	public function updateStatus(Client $client) {
		$client->status = !$client->status;
		return $client->save();
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