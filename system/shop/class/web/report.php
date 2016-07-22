<?php
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
	
	
require_once WEB_ROOT.'/includes/lib/phpexcel/PHPExcel.php';

	
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("百家cms")
							 ->setLastModifiedBy("百家cms")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("report file");



if($report=='orderreport')
{
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '支付单号')
            ->setCellValue('B1', '下单时间')
            ->setCellValue('C1', '订单总额')
            ->setCellValue('D1', '运费')
            ->setCellValue('E1', '付款方式')
            ->setCellValue('G1', '收货人')
            ->setCellValue('H1', '收货地址')	
            ->setCellValue('I1', '收货电话')
            ->setCellValue('J1', '')
            ->setCellValue('K1', '分类名称')
            ->setCellValue('L1', '产品名称')
            ->setCellValue('M1', '规格')
            ->setCellValue('N1', '商品单价')
            ->setCellValue('O1', '购买数量')
            ->setCellValue('P1', '商品总价');	
					
$i=2;
$index=0;
$countmoney=0;



foreach($list as $item){
	$countmoney=$countmoney+$item['price'];
	$priceother='';
	$index++;
	if(!empty($item['dispatchprice'])&&$item['dispatchprice']>0)
	{
			$priceother=$item['dispatchprice'];
	}else
	{
		$priceother="0";
		}
$objPHPExcel->setActiveSheetIndex(0)		
            ->setCellValue('A'.$i,  $item['ordersn'].'-'.$item['id'])
            ->setCellValue('B'.$i, date('Y-m-d  H:i:s',$item['createtime']))
            ->setCellValue('C'.$i, $item['price'])
             ->setCellValue('D'.$i, $priceother)
            ->setCellValue('E'.$i, $item['paytypename'])
            ->setCellValue('G'.$i, $item['address_realname'])
            ->setCellValue('H'.$i, $item['address_province'].$item['address_city'].$item['address_area'].$item['address_address'])
            ->setCellValue('I'.$i, $item['address_mobile']);
            
       
            
		$itemdatas=array();
		$itemdline=0;
			foreach($item['ordergoods'] as $itemgoods){
	
				if($itemdline==0)
				{
					$itemdatas['categoryname']='';
					$itemdatas['title']='';
					$itemdatas['optionname']='';
					$itemdatas['price']='';
					$itemdatas['total']='';
					$itemdatas['goodstotal']='';
						$sline='';	
				}else
				{
					
						$sline="\n";
				}
					$itemdatas['categoryname']=$itemdatas['categoryname'].$sline.$itemgoods['categoryname'];
					$itemdatas['title']=$itemdatas['title'].$sline.$itemgoods['title'];
					$itemdatas['optionname']=$itemdatas['optionname'].$sline.$itemgoods['optionname'];
					$itemdatas['price']=$itemdatas['price'].$sline.$itemgoods['price'];
					$itemdatas['total']=$itemdatas['total'].$sline.$itemgoods['total'];
					$itemdatas['goodstotal']=$itemdatas['goodstotal'].$sline.round(($itemgoods['total']*$itemgoods['price']),2);
					$itemdline=$itemdline+1;
			}
			
				$objPHPExcel->setActiveSheetIndex(0)		
				  ->setCellValue('J'.$i, '')
             ->setCellValue('K'.$i, $itemdatas['categoryname'])
            ->setCellValue('L'.$i, $itemdatas['title'])
            ->setCellValue('M'.$i, $itemdatas['optionname'])
            ->setCellValue('N'.$i, $itemdatas['price'])
            ->setCellValue('O'.$i, $itemdatas['total'])
            ->setCellValue('P'.$i,$itemdatas['goodstotal']);
				
//		$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':P'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);  
//$objPHPExcel->getActiveSheet()->getStyle( 'J'.$i.':P'.$i)->getAlignment()->setWrapText(true);  
			
			
			
	

//$objBorderA5 = $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':Q'.$i)->getBorders();
//$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//$objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); 
//$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//$objBorderA5->getBottom()->getColor()->setARGB('FFFF0000');
// $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':P'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
 
 	$i++;	
}					
 	

		
$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5); 
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50); 
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5); 
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25); 
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(65); 
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20); 
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10); 
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10); 
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10); 
$objPHPExcel->getActiveSheet()->setTitle('订单统计');
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report_'.time().'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

	