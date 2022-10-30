<?php

namespace App\Repositories\Configuration\Master;

use App\Models\Configuration\Master\Union;
use App\Repositories\Configuration\Master\DistrictRepository;
use App\Repositories\Configuration\Master\DivisionRepository;
use App\Repositories\Configuration\Master\UpozilaRepository;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Datatables;

class UnionRepository {

	protected $upozila;
	protected $division;
	protected $district;
	protected $union;

	/**
	 * Instantiate a new instance.
	 *
	 * @return void
	 */
	public function __construct(
		DivisionRepository $division,
		DistrictRepository $district,
		UpozilaRepository $upozila,
		Union $union
	) {
		$this->upozila = $upozila;
		$this->division = $division;
		$this->district = $district;
		$this->union = $union;
	}

	public function model() {
		return Union::class;
	}

	private function route() {
		return 'admin.configuration.master.union.';
	}

	private function permission() {
		return '-union';
	}

	/**
	 * Get union query
	 *
	 * @return Union query
	 */
	public function getQuery() {
		return $this->union;
	}

	/**
	 * Count union
	 *
	 * @return integer
	 */
	public function count() {
		return $this->union->count();
	}

	/**
	 * List all union by name & id
	 *
	 * @return array
	 */
	public function listAll() {
		return $this->union->all()->pluck('name', 'id')->prepend(_lang('Select Union'), '');
	}

	/**
	 * List all union by name & id for select option
	 *
	 * @return array
	 */
	public function selectAll() {
		return $this->union->all(['name', 'id']);
	}

	/**
	 * List all union by id
	 *
	 * @return array
	 */
	public function listId() {
		return $this->union->all()->pluck('id')->all();
	}

	/**
	 * Get all union
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->union->all();
	}

	/**
	 * Find union with given id.
	 *
	 * @param integer $id
	 * @return Union
	 */
	public function find($id) {
		return $this->union->find($id);
	}

	/**
	 * Find union with given id or throw an error.
	 *
	 * @param integer $id
	 * @return Union
	 */
	public function findOrFail($id, $field = 'message') {
		$union = $this->union->find($id);
		if (!$union) {
			throw ValidationException::withMessages([$field => _lang('Union Not Found.')]);
		}
		return $union;
	}

	/**
	 * Get all filtered data
	 *
	 * @param array $params
	 * @return Union
	 */
	public function getData($params) {
		$division = gv($params, 'division');
		$district = gv($params, 'district');
		$upozila = gv($params, 'upozila');
		$query = $this->district->with('division')->where('division_id', $division)->where('district_id', $district_id)
			->where('upozila_id', $upozila)->get();
		return $query;
	}

	/**
	 * Pre Requisite For division using given params.
	 *
	 * @param array $params
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function preRequisite($union = Null) {
		$divisions = $this->division->listAll();
		$compact = compact('divisions');
		if ($union) {
			$districts = $this->district->getQuery()->with('cities')->where('division_id', $union->division_id)->pluck('name', 'id')->prepend(trans('select.union'), '');
		} else if (config('satt.default_division_id')) {
			$districts = $this->district->getQuery()->with('cities')->where('division_id', config('satt.default_division_id'))->pluck('name', 'id')->prepend(trans('select.union'), '');
			$compact = compact('divisions', 'districts');
		}
		//dd($divisions);
		return $compact;
	}

	/**
	 * Get all data for Index
	 */
	public function datatable() {
		$models = $this->getAll();
		return Datatables::of($models)
			->addIndexColumn()
			->addColumn('district', function ($model) {
				return $model->district ? '<strong>' . $model->district->name . '</strong> (' . $model->district->division->name . ')' : '';
			})
			->addColumn('upozila', function ($model) {
				return $model->upozila ? '<strong>' . $model->upozila->name . '</strong>' : '';
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
			->rawColumns(['action', 'name', 'district', 'upozila'])
			->make(true);
	}

	/**
	 * Get all filtered data for printing
	 *
	 * @param array $params
	 * @return Union
	 */
	public function print($params) {
		return $this->getData($params)->get();
	}

	/**
	 * Create a new union.
	 *
	 * @param array $params
	 * @return Union
	 */
	public function create($params) {
		return $this->union->forceCreate($this->formatParams($params));
	}

	/**
	 * Prepare given params for inserting into database.
	 *
	 * @param array $params
	 * @param integer $division_id
	 * @return array
	 */
	private function formatParams($params, $union_id = null) {
		$formatted = [
			'division_id' => gv($params['division'], 'id'),
			'district_id' => gv($params['district'], 'id'),
			'upozila_id' => gv($params['upozila'], 'id'),
			'name' => gv($params, 'name'),
		];
		$formatted['options'] = [];
		return $formatted;
	}

	/**
	 * Update given union.
	 *
	 * @param Union $union
	 * @param array $params
	 *
	 * @return Union
	 */
	public function update(Union $union, $params) {
		return $union->forceFill($this->formatParams($params, $union->id))->save();
	}

	/**
	 * Find union & check it can be deleted or not.
	 *
	 * @param integer $id
	 * @return Union
	 */
	public function deletable($id) {
		$union = $this->findOrFail($id);
		// if ($union->employeeDesignations()->count()) {
		// 	throw ValidationException::withMessages(['message' => _lang('Upozila Associated With Others."')]);
		// }
		return $union;
	}

	/**
	 * Delete union.
	 *
	 * @param integer $id
	 * @return bool|null
	 */
	public function delete(Union $union) {
		return $union->delete();
	}

	/**
	 * Delete multiple union.
	 *
	 * @param array $ids
	 * @return bool|null
	 */
	public function deleteMultiple($ids) {
		return $this->union->whereIn('id', $ids)->delete();
	}

	public function actions($data) {
		if ($data['action'] == 'delete') {
			$this->deleteMultiple($data['ids']);
			return 'Unions Deleted Successfull';
		}
	}
}