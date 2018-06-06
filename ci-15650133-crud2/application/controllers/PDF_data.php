<?php   
defined('BASEPATH') OR exit('No deirect script access allowed');

	/**
	* `
	*/
	class PDF_data extends CI_Controller
	{
			public function __construct()
		{
			parent::__construct();
			if ($this->session->userdata('userid') and $this->session->userdata('pass')) {
				# code...
				$this->load->model('m_aplikasi');

				// require_once APPATH."libraries/PHPExcel/Classes/PHPExcel.php";
				$this->load->library('tcpdf/tcpdf.php');
			} else {
				# code...			
				redirect(base_url('login'));	
			}
			
		}

		public function index() {
			$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
			$rendererLibraryPath = APPATH."libraries/tcpdf";


			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator('Silva')
										->setLastModifiedBy('Silva')
										->setTitle('Office 20017')
										->setSubject('Office 2007')
										->setDescription('Document for office using php')
										->setKeywords('offie 2007 openxml php')
										->setCategory('Result File');

			// judul
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Daftar Siswa');
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','NO')
												->setCellValue('B3','NIM')
												->setCellValue('C3','NAMA');

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);


			$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->getFont()->setBold(true);

			// set border cell
			$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->applyFromArray(
				array(
					'borders'=> array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => '9E9E9E9E')
							)
						)
					)
				);
			$objPHPExcel->getActiveSheet()
				->getStyle('A3:C3')
				->getFill()
				->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('2328614');

			$daftar_mhs = $this->m_aplikasi->daftar_mahasiswa()->result();
			$no = 1;
			$baris = 4;
			foreach ($daftar_mhs as $r) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$baris,$no)
				->setCellValue('B'.$baris,$r->nim)
				->setCellValue('C'.$baris,$r->nama);

				$objPHPExcel->getActiveSheet()->getStyle("A".$baris.":C".$baris)->applyFromArray(
					array('borders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '9E9E9E')
						)
					)
				);

				$objPHPExcel->getActiveSheet()
					->getStyle("A".$baris.":C".$baris)
					->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setRGB('FBEE03');
				$no++;
				$baris++;

				//rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Daftar Siswa');
				$objPHPExcel->setActiveSheetIndex(0);
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');


				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
				$objWriter->save('php://output');

				unset($objPHPExcel, $daftar_mhs, $no, $baris, $r, $objWriter);
			}
		}
	}
?>