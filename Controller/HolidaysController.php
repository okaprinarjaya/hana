<?php
App::uses('AppController', 'Controller');

/**
 * Holidays Controller
 *
 * @property Holiday $Holiday
 * @property PaginatorComponent $Paginator
 */
class HolidaysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Holiday->virtualFields['START_DATE'] = "MIN(holiday_date)";
		$this->Holiday->virtualFields['FINISH_DATE'] = "MAX(holiday_date)";

		$this->Paginator->settings = array(
			'Holiday' => array(
'conditions' => array('YEAR(holiday_date)' => date('Y')),
				'group' => array('holiday_name', 'DATE(created)'),
				'order' => array('holiday_date' => 'asc')
			)
		);

		$this->Holiday->recursive = 0;
		$this->set('holidays', $this->Paginator->paginate('Holiday'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$sd = trim($this->request->data['Foo']['start_date']);
			$fd = trim($this->request->data['Foo']['finish_date']);
			$save = false;

			if ($sd == $fd) {
				$data = array(
					'Holiday' => array(
						'holiday_name' => $this->request->data['Holiday']['holiday_name'],
						'holiday_date' => $sd
					)
				);

				$this->Holiday->create();
				$save = $this->Holiday->save($data);

			} else {
				$dates_range = $this->generateDateRange($this->request->data['Foo']['start_date'], $this->request->data['Foo']['finish_date']);
				$data = array();

				foreach ($dates_range as $item) {
					$holiday = array(
						'Holiday' => array(
							'holiday_name' => $this->request->data['Holiday']['holiday_name'],
							'holiday_date' => $item
						)
					);

					array_push($data, $holiday);
				}

				$save = $this->Holiday->saveMany($data);
			}

			if ($save) {
				$this->Session->setFlash(__('The holiday has been saved.'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'));
			}
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @return void
 */
	public function delete($holiday_name, $start_date, $finish_date) {
		$this->request->onlyAllow('post', 'delete');

		$del = $this->Holiday->deleteAll(array(
			'Holiday.holiday_name' => $holiday_name,
			'Holiday.holiday_date BETWEEN ? AND ?' => array($start_date, $finish_date)
		), false);

		if ($del) {
			$this->Session->setFlash(__('The holiday has been deleted.'));
		} else {
			$this->Session->setFlash(__('The holiday could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('action' => 'index'));
	}

	private function generateDateRange($start_date, $finish_date)
	{
		$finish = new DateTime($finish_date);
		$finish = $finish->modify('+1 day');
		$periods = new DatePeriod(new DateTime($start_date), new DateInterval('P1D'), $finish);
		$dates = array();

		foreach ($periods as $period) {
			array_push($dates, $period->format('Y-m-d'));
		}

		return $dates;
	}
}
