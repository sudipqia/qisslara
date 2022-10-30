<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\Court;
use App\Repositories\Configuration\Category\CourtCategoryRepository;
use App\Repositories\Configuration\Master\DistrictRepository;
use App\Repositories\Configuration\Master\DivisionRepository;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class CourtRepository {

	protected $court;
	protected $division;
	protected $district;
	protected $category;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		Court $court,
		DistrictRepository $district,
		DivisionRepository $division,
		CourtCategoryRepository $category
	) {
		$this->court = $court;
		$this->district = $district;
		$this->division = $division;
		$this->category = $category;
	}

	public function model() {
		return Court::class;
	}

	private function route() {
		return 'admin.configuration.master.court.';
	}

	private function permission() {
		return '-court';
	}

	/**
	 * Get court query
	 *
	 * @return Court query
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
		return $this->court->all()->pluck('name', 'id')->prepend(_lang('select_court_master'), '');
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
	 * @return Court
	 */
	public function find($id) {
		return $this->court->find($id);
	}

	public function preReuisiteSelectForm($params) {
		$data['name'] = gv($params, 'name');
		$data['court_category'] = gv($params, 'court_category');
		$data['form_id'] = gv($params, 'form_id');
		$divisions = $this->division->listAll();
		$categories = $this->category->getQuery()->where('id', $data['court_category'])->pluck('name', 'id')->prepend(trans('select.division'), '');
		return compact('data', 'categories', 'divisions');
	}

	public function preRequisite($id = Null) {
		$divisions = $this->division->listAll();
		$categories = $this->category->listAll();
		$compact = compact('divisions', 'categories');
		if ($id) {
			$court = $this->find($id);
			$districts = $this->district->getQuery()->where('division_id', $court->division_id)->pluck('name', 'id')->prepend(_lang('Select District'), '');
			$compact = compact('divisions', 'categories', 'districts');
		}

		//dd($divisions);
		return $compact;
	}

	/**
	 * Find court with given id or throw an error.
	 *
	 * @param integer $id
	 * @return Court
	 */
	public function findOrFail($id, $field = 'message') {
		$court = $this->court->find($id);
		if (!$court) {
			throw ValidationException::withMessages([$field => _lang('court_master_not_found')]);
		}
		return $court;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return Court
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
			->editColumn('division', function ($model) {
				return $model->division->name;
			})
			->editColumn('district', function ($model) {
				return $model->district->name;
			})
			->editColumn('category', function ($model) {
				return $model->court_category->name;
			})
			->addColumn('action', function ($model) {
				$route = $this->route();
				$permission = $this->permission();
				return view('action', compact('model', 'route', 'permission'));
			})
			->removeColumn('created_at')
			->removeColumn('updated_at')
			->rawColumns(['action', 'name', 'division', 'district', 'category'])
			->make(true);
	}

	/**
	 * Get all filtered data for printing
	 *
	 * @param array $params
	 * @return Court
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new court.
	 *
	 * @param array $params
	 * @return Court
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
			'division_id' => gv($params['division'], 'id'),
			'district_id' => gv($params['district'], 'id'),
			'court_category_id' => gv($params['court_category'], 'id'),
			'description' => gv($params, 'description'),
		];
		return $formatted;
	}

	/**
	 * Update given court.
	 *
	 * @param Court $court
	 * @param array $params
	 *
	 * @return Court
	 */
	public function update(Court $court, $params) {
		return $court->forceFill($this->formatParams($params, $court->id))->save();
	}

	/**
	 * Find court & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return Court
	 */
	public function deletable($id) {
		$court = $this->findOrFail($id);
		// if ($court->districts()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('court_master_associate')]);
		// }
		return $court;
	}

	/**
	 * Delete court.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(Court $court) {
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

	public function updateStatus(Court $court) {
		$court->status = !$court->status;
		return $court->save();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'Court Delete';
		}
	}
}