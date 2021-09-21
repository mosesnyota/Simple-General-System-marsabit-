<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
//Route::get('login/{page?}', 'Auth\LoginController@showLoginForm')->name('login');
//Route::get('/login','App\Http\Controllers\Auth\LoginController');

Route::get('/home', 'MyController@index')->name('home');
Route::get('/importdbams', 'DashboardController@index');

Route::get('/test', 'MyController@test')->name('test');

//this creates all the routes for staff
Route::get('/staff','StaffsController@index');
Route::post('/staff/store','StaffsController@store');
Route::post('/staff/addnewstaff','StaffsController@create');
Route::get('/editstaff/{staff}','StaffsController@edit');
Route::post('/editstaff/update/{staff}','StaffsController@update');
Route::get('/staff/destroy/{staff}','StaffsController@destroy');
Route::get('/staff/{staff}/view','StaffsController@show');




Route::get('/sponsors','SponsorsController@index');
Route::post('/sponsors/store','SponsorsController@store');
Route::get('/editsponsor/{sponsor}','SponsorsController@edit');
Route::post('/editsponsor/update/{sponsor}','SponsorsController@update');
Route::get('/editsponsor/destroy/{sponsor}','SponsorsController@destroy');

Route::get('/viewsponsor/{sponsor}/view','SponsorsController@show');
Route::get('/viewsponsor/viewfundings/{sponsor}/view','SponsorsController@showfundings');
Route::get('/viewsponsor/viewprojects/{sponsor}/view','SponsorsController@showprojects');
Route::get('/viewsponsor/printsponsorprojects/{sponsor}/print','SponsorsController@printprojects');
Route::get('/viewsponsor/printsponsorfundings/{sponsor}/print','SponsorsController@printfunds');




Route::get('/projects','ProjectsController@index');
Route::post('/savenewproject','ProjectsController@store');
Route::post('/editproject/saveupdatedproject/{project}','ProjectsController@update');
Route::get('/viewproject/editproject/{project}/edit','ProjectsController@edit');
Route::get('/newproject','ProjectsController@create');
Route::get('/viewproject/{project}','ProjectsController@show');

Route::get('/viewproject/editdisbursment/{project}','DisbursmentController@edit');
Route::post('/viewproject/editdisbursment/saveediteddisbursement/{project}','DisbursmentController@update');




Route::post('viewproject/updatevoteheads/{votehead}','VoteheadController@updatevoteheads');


Route::get('/viewproject/projectreport/{project}/download','ProjectsController@printreport');

Route::get('/viewproject/deleteproject/{project}/delete','ProjectsController@destroy');

Route::post('/votehead/store','VoteheadController@store');
Route::post('/disbursment/store','DisbursmentController@store');
Route::post('/disbursment/uploadexcel','DisbursmentController@uploadexcel');


Route::get('/viewproject/disbursment/destroy/{id}','DisbursmentController@destroy')->name('disbursment.destroy');

Route::get('/viewproject/downloadPDF/{project}/download','ProjectsController@printPdfReport');

Route::get('/viewproject/downloadExcel/{project}/download','ProjectsController@printExcel');

Route::post('/activity/store','ActivitiesController@store');
Route::post('/activity/update/{activity}','ActivitiesController@update');


Route::get('/viewproject/editvotehead/{votehead}','VoteheadController@edit');

Route::post('/saveeditedvotehead/{votehead}','VoteheadController@update');

Route::get('/viewproject/deletevotehead/{votehead}','VoteheadController@destroy');



Route::get('/viewproject/deletemilestone/{milestone}','ActivitiesController@destroy');
Route::get('/viewproject/editmilestone/{milestone}','ActivitiesController@edit');
Route::post('/saveupdatedmilestone/{activity}','ActivitiesController@saveupdated');




Route::get('/funds','FundingController@index');
Route::post('/funds/store','FundingController@store');
Route::get('/funds/{fund}/edit','FundingController@edit');
Route::post('/funds/{fund}/update','FundingController@update');
Route::get('/funds/{fund}/destroy','FundingController@destroy');
Route::get('/funds/report/{start}/{end}','FundingController@report');
Route::post('/funds/report1','FundingController@report1');




Route::get('/pettycash/{petty}/destroy','PettyCashs@destroy');
Route::get('/pettycash/{petty}/edit','PettyCashs@edit');
Route::post('/pettycash/report1','PettyCashs@report1');
Route::get('/pettycash/pettycashreport/{start}/{end}','PettyCashs@printReport');
Route::get('pettycash/pettycashreceiptprint/{petty}/print','PettyCashs@printPettyReceipt');
Route::get('pettycash/reprintreceipt/{petty}/print','PettyCashs@reprintReceipt');
Route::post('/pettycash/{petty}/update','PettyCashs@update');
Route::get('/pettycash','PettyCashs@index');
Route::post('/pettycash/store','PettyCashs@store');


Route::get('/expense','ExpensesController@index');
Route::post('/expense/store','ExpensesController@store');
Route::get('/expense/{fund}/edit','ExpensesController@edit');
Route::post('/expense/{fund}/update','ExpensesController@update');
Route::get('/expense/{fund}/destroy','ExpensesController@destroy');
Route::get('/expense/report/{start}/{end}','ExpensesController@report');
Route::post('/expense/report1','ExpensesController@report1');

Route::get('/viewproject/comment/{project}/edit','ProjectsController@comment');
Route::post('/viewproject/comment/{project}/save','ProjectsController@savecomment');

Route::get('/expenseanalytics','AnalyticsController@index');

Route::get('/suppliers','SupplierController@index');
Route::get('/suppliers/{supplier}/edit','SupplierController@edit');
Route::post('/suppliers/store','SupplierController@store');
Route::get('/editsupplier/{supplier}','SupplierController@edit');
Route::post('/editsupplier/update/{supplier}','SupplierController@update');
Route::get('/supplier/destroy/{supplier}','SupplierController@destroy');
Route::get('/viewsupplier/{supplier}/view','SupplierController@show');
Route::get('/viewsupplier/viewbills/{supplier}/view','SupplierController@viewBills');

Route::get('/bills','BillsController@index');

Route::get('/roles','RolesController@index');
Route::post('/roles/store','RolesController@store');
Route::get('/permissions','RolesController@permissions');
Route::post('/permissions/store','RolesController@storepermission');

Route::get('/roles/{role}/permissions','RolesController@assignpermissions');
Route::POST('roles/savepermissions/{role}','RolesController@savepermissions');

Route::get('/roles/{role}/permissions','RolesController@assignpermissions');

Route::get('/viewproject/budgetstatement/{project}/statement','ProjectsController@budgetstatement');

Route::post('/budget/store/{project}','ProjectsController@updatebudget');
Route::get('/viewproject/export/{votehead}','DisbursmentController@exportDisbursementVotehead');


Route::get('/pettycash/pushtoproject/{transaction}/push','PettyCashs@pushtoproject');
Route::post('/pettycash/pushtransaction/{transaction}/push','PettyCashs@savepushedtransaction');


Route::get('/viewproject/setexchagerate/{project}/currency','ProjectsController@setExchangeRate');
Route::get('/viewproject/setcurrency/{project}/currency','ProjectsController@setCurrency');

Route::get('/locations','LocationsController@index');
Route::post('/locations/store','LocationsController@store');
Route::get('/locations/{location}/edit','LocationsController@edit');
Route::get('/locations/{location}/destroy','LocationsController@destroy');
Route::post('/locations/{location}/update','LocationsController@update');

Route::get('/productcategory','ProductCategoryController@index');
Route::post('/productcategory/store','ProductCategoryController@store');
Route::get('/productcategory/{category}/edit','ProductCategoryController@edit');
Route::get('/productcategory/{category}/destroy','ProductCategoryController@destroy');
Route::post('/productcategory/{category}/update','ProductCategoryController@update');

Route::get('/products','ProductsController@index');
Route::post('/products/store','ProductsController@store');
Route::get('/products/{product}/edit','ProductsController@edit');
Route::get('/products/{product}/destroy','ProductsController@destroy');
Route::post('/products/{product}/update','ProductsController@update');
Route::get('/products/{product}/view','ProductsController@show');
Route::post('/products/receivestock','ProductsController@receivestock');
Route::post('/products/issueproduct','ProductsController@issueproduct');
Route::get('/products/productmovements','ProductsController@productmovements');

Route::get('/catalogue','CatalogueController@index');
Route::post('/catalogue/store','CatalogueController@store');
Route::post('/catalogue/storecopy','CatalogueController@storecopy');

Route::get('/catalogue/{catalogue}/edit','CatalogueController@edit');
Route::get('/catalogue/{catalogue}/destroy','CatalogueController@destroy');
Route::post('/catalogue/{catalogue}/update','CatalogueController@update');
Route::get('/catalogue/{catalogue}/view','CatalogueController@show');
Route::post('/catalogue/receivestock','CatalogueController@receivestock');
Route::post('/catalogue/issueasset','CatalogueController@issueasset');
Route::get('/catalogue/catalogmovements','CatalogueController@catalogmovements');

Route::get('/catalogcategories','AssetCategoriesController@index');
Route::post('/catalogcategories/store','AssetCategoriesController@store');
Route::get('/catalogcategories/{category}/edit','AssetCategoriesController@edit');
Route::get('/catalogcategories/{category}/destroy','AssetCategoriesController@destroy');
Route::post('/catalogcategories/{category}/update','AssetCategoriesController@update');

Route::get('/customers','CustomersController@index');
Route::post('/customers/store','CustomersController@store');
Route::get('/customers/{customer}/edit','CustomersController@edit');
Route::post('/customers/{customer}/update','CustomersController@update');
Route::get('/customers/{customer}/destroy','CustomersController@destroy');
Route::get('/customers/{customer}/view','CustomersController@show');

Route::get('/customers/{customer}/viewpayments','CustomersController@viewpayments');
Route::get('/customers/{customer}/viewinvoices','CustomersController@viewinvoices');

Route::get('/production','InvoicesController@index'); 
Route::get('/unpaidinvoices','InvoicesController@unpaidinvoices'); 

Route::get('/invoices','InvoicesController@invoice');
Route::get('/invoice','InvoicesController@newinvoice');
Route::get('/invoice/{invoice}/open','InvoicesController@openinvoice');
Route::post('/invoice/store','InvoicesController@store');
Route::get('/jobestimate/{job}','InvoicesController@jobestimate');
Route::post('/savejobestimate','InvoicesController@savejobestimate');

Route::post('invoice/showdetails','InvoicesController@showdetails');

Route::get('/school','SchoolController@index');
Route::get('/students','StudentsController@index');
Route::get('/students/create','StudentsController@create');
Route::post('/students/store','StudentsController@store');
Route::get('/students/{student}/edit','StudentsController@edit');
Route::post('/students/{student}/update','StudentsController@update');
Route::get('/students/{student}/destroy','StudentsController@destroy');
Route::get('/students/{student}/view','StudentsController@show');

Route::get('/courses','CourseController@index');
Route::post('/courses/store','CourseController@store');
Route::get('/courses/{course}/edit','CourseController@edit');
Route::post('/courses/{course}/update','CourseController@update');
Route::get('/courses/{course}/destroy','CourseController@destroy');

Route::get('/schoolfees','SchoolFeeController@index')->name('schoolfees');
Route::get('/feebalances','SchoolFeeController@feebalances')->name('feebalances');
Route::post('/feevotehead/store','SchoolFeeController@saveVotehead');
Route::get('/feevotehead/{votehead}/edit','SchoolFeeController@editvotehead');
Route::get('/feevotehead/{votehead}/destroy','SchoolFeeController@destroyvotehead');
Route::post('/feevotehead/{votehead}/update','SchoolFeeController@updatevotehead');


Route::get('/schoolfees/{print}/printfeestatement','SchoolFeeController@printfeestatement');
Route::get('/schoolfees/{student}/viewinvoices/{year}/{Term}/printstatement ','SchoolFeeController@printStatement');



Route::get('/createfeeinvoice','SchoolFeeController@create');
Route::post('/savefeeinvoice','SchoolFeeController@savefeeinvoice');

Route::post('/getclasslists','StudentsController@getclasslists');
Route::get('/openclasslist/{course_id}/{cur_year}','StudentsController@printClassList');


Route::post('/fee/pay','SchoolFeeController@payfee');

Route::get('fee/printreceipt/{payment}/print','SchoolFeeController@printReceipt');
Route::get('fee/reprintreceipt/{payment}/print','SchoolFeeController@reprintReceipt');
Route::get('feereceipts','SchoolFeeController@feereceipts');
Route::get('fee/reprintreceipt/{payment}/reprint','SchoolFeeController@printReceipt');
Route::get('receipt/{payment}/edit','SchoolFeeController@editreceipt');

Route::post('receipt/{payment}/update','SchoolFeeController@updateReceipt');
Route::get('receipt/{payment}/destroy','SchoolFeeController@deletefee');

Route::get('schoolfees/{student}/viewstatement','SchoolFeeController@viewstatement');

Route::get('/assetreport','CatalogueController@assetreport');
Route::get('/openReportAssets','CatalogueController@openReportAssets');

Route::post('/products/report1','ProductsController@report1');
Route::get('/products/printreport1/{start}/{end}/open','ProductsController@printReport1');

Route::post('/products/report2','ProductsController@report2');
Route::get('/products/summaryreport/{start}/{end}/open','ProductsController@summaryReport');

Route::post('/products/report3','ProductsController@report3');
Route::get('/products/breakdown/{start}/{end}/open','ProductsController@reasonsReport');
Route::get('/invoice/{invoice}/printpdf','InvoicesController@printpdf');
Route::get('/invoice/{invoice}/pay','InvoicesController@pay');
Route::post('/invoice/report1','InvoicesController@report1');
Route::get('/invoice/report/{start}/{end}','InvoicesController@printReport');

Route::post('/invoice/report2','InvoicesController@report2');
Route::get('/invoice/report2/{start}/{end}','InvoicesController@printReport2');

Route::post('/invoice/pay','InvoicesController@saveInvoicePayment');
Route::get('invoice/production/{id}/receipt','InvoicesController@receipt2');
Route::get('/invoice/payments','InvoicesController@payments');
Route::post('/pettycash/complete','PettyCashs@complete');

Route::get('/academics','AcademicsController@index');
Route::get('/subjects','SubjectsController@index');
Route::get('/subjects/{subject}/edit','SubjectsController@edit');
Route::post('/subjects/{subject}/update','SubjectsController@update');
Route::get('/subjects/{subject}/destroy','SubjectsController@destroy');
Route::post('/subjects/store','SubjectsController@store');

Route::get('/marks','AcademicsController@marks');
Route::get('/marks/{marks}/edit','AcademicsController@edit');
Route::post('/marks/{marks}/update','AcademicsController@update');
Route::get('/marks/{marks}/destroy','AcademicsController@destroy');

Route::post('/marks/proceed','AcademicsController@proceed');
Route::post('/marks/store','AcademicsController@store');

Route::post('/reportforms','ReportFormsController@index');
Route::post('/reportforms/print','ReportFormsController@reportForms');

Route::post('/markssheet','ReportFormsController@marksSheet');
Route::get('/markssheet/{mark1}/{mark2}/{mark3}/{mark4}/print','ReportFormsController@printSheet');

Route::get('/defineitems/{invoice}/view','InvoicesController@defineitems');
Route::get('/defineitems/{invoice}/invoice/{item}/edit','InvoicesController@edititem');

Route::get('/defineitems/{invoice}/invoice/{item}/additems','InvoicesController@additems');
Route::get('/invoice/{invoice}/{item}/additems','InvoicesController@additems');

Route::post('/invoice/{invoiceid}/{invoicedetailid}/saveediteditem','InvoicesController@saveediteditem');

Route::get('/invoice/{invoiceid}/{invoicedetailid}/edit','InvoicesController@editinvoicedetails');

Route::get('invoice/{invoice_id}/payment/{payment_id}/edit','InvoicesController@editpay');

Route::post('/invoice/{invoiceid}/payment/{paymentid}/savepay','InvoicesController@savepayedit');

Route::get('invoice/{invoice_id}/{detailid}/destroy','InvoicesController@deletedetail');

Route::get('customers/{customer_id}/getstatement','CustomersController@getStatement');

Route::get('/catalogue/{asset}/catalogue/{assetcopy}/editcopy', 'CatalogueController@editcopy');
Route::post('/catalogue/{asset}/catalogue/{assetcopy}/update', 'CatalogueController@updatecopy');


Route::get('/students/{student}/remove', 'StudentsController@remove');
Route::get('/students/old', 'StudentsController@old');
Route::post('/invoice/{invoice}/invoice/pay','InvoicesController@saveInvoicePayment2');
Route::get('invoice/{invoice}/invoice/production/{receipt}/receipt','InvoicesController@printReceipt');


Route::get('/students/{student}/printfeestatement','SchoolFeeController@printfeestatement' );
 
Route::get('/students/{student}/viewinvoices/{year}/{term}/view','SchoolFeeController@printstatement' );


//NEW CHANGES

Route::get('invoice/{invoice_id}/destroy','InvoicesController@completedelete');
Route::get('quotations','QuotationsController@index');
Route::get('newquotation','QuotationsController@create');
Route::post('quotation/store','QuotationsController@store');
Route::get('/quotationestimates/{job}','QuotationsController@quotationestimates');
Route::post('/savequotation','QuotationsController@savejobestimate');
Route::get('/quotations/{qut}/open','QuotationsController@openquotation');
Route::get('/quotations/{qt}/printpdf','QuotationsController@printpdf');
Route::get('/quotations/{qt}/edit','QuotationsController@edit');
Route::post('/quotations/{qt}/update','QuotationsController@update');
Route::get('/quotations/{qt}/{item}/edit','QuotationsController@itemedit'); 
Route::post('/quotations/{qt}/{item}/saveediteditem','QuotationsController@saveediteditem'); 
Route::get('quotations/{qt}/{item}/destroy','QuotationsController@destroyitem');
Route::get('quotations/{qt}/destroy','QuotationsController@destroy');
Route::get('quotations/{qt}/accept','QuotationsController@makeinvoice');
Route::post('invoice/{qt}/discount','InvoicesController@discount');
Route::post('invoices/departreport','InvoicesController@departreport');
Route::get('invoices/departreport/{start}/{end}/print','InvoicesController@opendepartreport');


Route::get('/expensecategory', 'ExpensesCategoryController@index');
Route::get('/expencategory/{exp}/edit', 'ExpensesCategoryController@edit');
Route::post('/expencategory/{PDO}/update', 'ExpensesCategoryController@update');
Route::get('/expencategory/{pd}/destroy', 'ExpensesCategoryController@destroy');
Route::post('/expensecategory/store', 'ExpensesCategoryController@store');

Route::post('/expense/report2', 'ExpensesController@report2');
Route::get('/expense/{startdate}/{enddate}/summaryreport', 'ExpensesController@report3');

Route::get('/schoolfees/{student_id}/viewinvoices/{year}/{term}/view', 'SchoolFeeController@viewinvoices')->name('viewinvoices');;
Route::get('/schoolfees/{student}/editfee/{id}/edit', 'SchoolFeeController@editFeeInvoice');
Route::post('/schoolfees/{student}/editfee/{invoice}/update', 'SchoolFeeController@updatefeeinvoice');
Route::post('/schoolfees/{student_id}/viewinvoices/{year}/{term}/savenewfee', 'SchoolFeeController@savenewfee')->name('savenewfee');;



Route::post('/schoolfees/{student}/addfeeinvoice', 'SchoolFeeController@addfeeinvoice')->name('addfeeinvoice');;
Route::get('/catalogue/{asset}/{assetcopy}/view','AssetCopyItemsController@openCopiesItems');

Route::post('/catalogue/{asset}/{assetcopy}/saveitem','AssetCopyItemsController@store');

Route::get('/catalogue/{asset}/{assetcopy}/asetitem/{itemid}/edit', 'AssetCopyItemsController@edit');

Route::post('/catalogue/{asset}/{assetcopy}/asetitem/{itemid}/update','AssetCopyItemsController@update');

Route::get('/catalogue/{asset}/{assetcopy}/catalogue/{item}/destroy','AssetCopyItemsController@destroy');


Route::post('/catalogue/{asset}/saveitem','AssetCopyItemsController@saveitems');
Route::get('/viewallassets','CatalogueController@viewAll');

Route::get('/catalogue/{productid}/pick', 'CatalogueController@pickitem');
Route::get('/catalogue/issueItems2', 'CatalogueController@issueItems2');
Route::get('/catalogue/{productid}/remove', 'CatalogueController@removecart');
Route::post('/catalogue/saveissueditems', 'CatalogueController@saveissueditems');

Route::post('/students/fee/pay', 'SchoolFeeController@payfee');

Route::get('students/fee/printreceipt/{payment}/print','SchoolFeeController@printReceipt');