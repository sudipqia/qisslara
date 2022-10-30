<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Configuration\Master\DistrictRepository;
use App\Repositories\Configuration\Master\DivisionRepository;
use App\Repositories\Configuration\Master\UpozilaRepository;
use App\Models\Configuration\Master\Court;
use Illuminate\Http\Request;

class SelectController extends Controller {

	protected $request;
	protected $division;
	protected $district;
	protected $upozila;

	public function __construct(
		DivisionRepository $division,
		DistrictRepository $district,
		UpozilaRepository $upozila,
		Request $request
	) {
		$this->request = $request;
		$this->division = $division;
		$this->district = $district;
		$this->upozila = $upozila;
	}
	/**
	 * Display a listing of Division.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function division() {
		return $this->division->getData($this->request->q);
	}

	/**
	 * Display a listing of Division.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function district() {
		return $this->district->getData($this->request->all());
	}

	/**
	 * Display a listing of Division.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function upozila() {
		return $this->upozila->getData($this->request->all());
	}

	/**
	 * Display a listing of Division.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function court() {
		$category = gv($this->request->all(), 'category');
		$court =Court::where('court_category_id',$category)->get();
		return $court;
	}
}
