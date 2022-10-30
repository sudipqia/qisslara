<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\Upozila;
use App\Repositories\Configuration\Master\DistrictRepository;
use App\Repositories\Configuration\Master\DivisionRepository;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class UpozilaRepository {

	protected $upozila;
	protected $division;
	protected $district;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		DivisionRepository $division,
		DistrictRepository $district,
		Upozila $upozila
	) {
		$this->upozila = $upozila;
		$this->division = $division;
		$this->district = $district;
	}

	public function model() {
		return Upozila::class;
	}

	private function route() {
		return 'admin.configuration.master.upozila.';
	}

	private function permission() {
		return '-upozila';
	}

	/**
	 * Get upozila query
	 *
	 * @return Upozila query
	 */
	public function getQuery() {
		return $this->upozila;
	}

	/**
	 * Count upozila
	 *
	 * @return integer
	 */
	public function count() {
		return $this->upozila->count();
	}

	/**
	 * List all upozila by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->upozila->all()->pluck('name', 'id')->prepend(trans('select.upozila'), '');
	}

	/**
	 * List all upozila by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->upozila->all(['name', 'id']);
	}

	/**
	 * List all upozila by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->upozila->all()->pluck('id')->all();
	}

	/**
	 * Get all upozila
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->upozila->all();
	}

	/**
	 * Find upozila with given id.
	 *
	 * @param integer $id
	 * @return Upozila
	 */
	public function find($id) {
		return $this->upozila->find($id);
	}

	/**
	 * Find upozila with given id or throw an error.
	 *
	 * @param integer $id
	 * @return Upozila
	 */
	public function findOrFail($id, $field = 'message') {
		$upozila = $this->upozila->find($id);
		if (!$upozila) {
			throw ValidationException::withMessages([$field => _lang('Upozila Not Found.')]);
		}
		return $upozila;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return Upozila
	 */
	public function getData($params) {
		$division = gv($params, 'division');
		$district = gv($params, 'district');
		$query = $this->upozila->where('district_id', $district)->where('division_id', $division)
			->get();
		return $query;
	}

	/**
	 * Pre Requisite For division using given params.
	 *
	 * @param array $params
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function preRequisite($upozila = Null) {
		$divisions = $this->division->listAll();
		$compact = compact('divisions');
		if ($upozila) {
			$districts = $this->district->getQuery()->where('division_id', $upozila->division_id)->pluck('name', 'id')->prepend(trans('select.upozila'), '');
			$compact = compact('divisions', 'districts');
		} else if (config('satt.default_division_id')) {
			$districts = $this->district->getQuery()->where('division_id', config('satt.default_division_id'))->pluck('name', 'id')->prepend(trans('select.district'), '');
			$compact = compact('divisions', 'districts');
		}
		//dd($divisions);
		return $compact;
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
		$data['district'] = gv($params, 'district');
		$data['form_id'] = gv($params, 'form_id');
		$divisions = $this->division->getQuery()->where('id', $data['division'])->pluck('name', 'id')->prepend(trans('select.division'), '');
		$districts = $this->district->getQuery()->where('id', $data['district'])->pluck('name', 'id')->prepend(trans('select.upozila'), '');
		return compact('data', 'divisions', 'districts');
	}
	/**
	 * Get all data for Index
	 */
	public function datatable() {
		$models = $this->getAll();
		return Datatables::of($models)
			->addIndexColumn()
			->addColumn('district', function ($model) {
				return $model->district ? '<strong>' . $model->district->name . '</strong> (' . $model->division->name . ')' : '';
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
			->rawColumns(['action', 'name', 'district'])
			->make(true);
	}

	/**
	 * Get all filtered data for printing
	 *
	 * @param array $params
	 * @return Upozila
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new upozila.
	 *
	 * @param array $params
	 * @return Upozila
	 */
	public function create($params) {
		return $this->upozila->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $division_id
	 * @return array
	 */
	private function formatParams($params, $upozila_id = null) {
		$formatted = [
			'division_id' => gv($params['division'], 'id'),
			'district_id' => gv($params['district'], 'id'),
			'name' => gv($params, 'name'),
		];
		$formatted['options'] = [];
		return $formatted;
	}

	/**
	 * Update given upozila.
	 *
	 * @param Upozila $upozila
	 * @param array $params
	 *
	 * @return Upozila
	 */
	public function update(Upozila $upozila, $params) {
		return $upozila->forceFill($this->formatParams($params, $upozila->id))->save();
	}

	/**
	 * Find upozila & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return Upozila
	 */
	public function deletable($id) {
		$upozila = $this->findOrFail($id);
		if ($upozila->unions()->count()) {
			throw ValidationException::withMessages(['message' => _lang('Upozila Associated With Unios."')]);
		}
		return $upozila;
	}

	/**
	 * Delete upozila.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(Upozila $upozila) {
		return $upozila->delete();
	}

	/**
	 * Delete multiple upozila.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function deleteMultiple($ids) {
		return $this->upozila->whereIn('id', $ids)->delete();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'Upozilas Deleted Successfull';
		}
	}
}