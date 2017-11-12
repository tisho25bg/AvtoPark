<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleFormRequest extends FormRequest
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'brand'				 => 'required',
			'regNumber'			 => 'required|unique:vehicles,regNumber,' . $this->get('vhid'),
			'vehicle_engine'	 => 'required',
			'vehicle_type'		 => 'required',
			'vehicle_status'	 => 'required',
			'fuelConsumption'	 => 'required',
			'mileage'			 => 'required',
			'chargeWeight'		 => 'required',
			'insurance'			 => 'required',
			'technicalReview'	 => 'required',
		];
	}

	public function messages()
	{
		return [
			'brand.required'			 => 'Полето "Марка" е задължително!',
			'regNumber.required'		 => 'Полето "Регистрационен номер" е задължително!',
			'regNumber.unique'			 => 'В базата съществува МПС със зададения регистрационен номер!',
			'vehicle_engine.required'	 => 'Полето "Тип на двигателя" е задължително!',
			'vehicle_type.required'		 => 'Полето "Тип на МПС" е задължително!',
			'vehicle_status.required'	 => 'Полето "Статус на МПС" е задължително!',
			'fuelConsumption.required'	 => 'Полето "Разход на гориво" е задължително!',
			'mileage.required'			 => 'Полето "Изминати километри" е задължително!',
			'chargeWeight.required'		 => 'Полето "Полезен товар" е задължително!',
			'insurance.required'		 => 'Полето "Гражданска отговорност" е задължително!',
			'technicalReview.required'	 => 'Полето "Технически преглед" е задължително!',
		];
	}

}
