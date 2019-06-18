<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login/viewlogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'login/viewlogin';
$route['logout'] = 'login/logout';
$route['verify'] = 'login/check_cred';

//Viewing Routes -----------------------------------------------
$route['admin/menu'] = "adminview/viewmenu";
$route['admin/menu/getDetails'] = "adminview/menuGetDetails";
$route['admin/menu/addons'] = "adminview/menuAddons";
$route['admin/menu/menustock'] = "adminview/menuStock";
$route['admin/menu/promos'] = "adminview/menuPromos";
$route['admin/sales'] = "adminview/viewSales";
$route['admin/dashboard'] = "adminview/viewdashboard";
$route['admin/tables'] = "adminview/viewtables";
$route['admin/measurements'] = "adminview/viewUOM";
$route['admin/tables/getTables'] = "adminview/getTables";
$route['admin/menucategories'] = "adminview/viewmenucategories";
$route['admin/stockcategories'] = "adminview/viewstockcategories";
$route['admin/supplier'] = "adminview/viewsupplier";
$route['admin/supplier/getDetails'] = "adminview/supplierGetDetails";
$route['admin/accounts'] = "adminview/viewaccounts";
$route['admin/inventory'] = "adminview/viewinventory";
$route['admin/inventory/stockcard/(:num)'] = "adminview/viewstockcard/$1";
$route['admin/purchaseorders'] = "adminview/viewpurchaseorders";
$route['admin/spoilages/menu/add'] ="adminview/viewInsertSpoilageMenu";
$route['admin/spoilages/stock/add'] ="adminview/viewInsertSpoilageStock";
$route['admin/spoilages/addons/add'] ="adminview/viewInsertSpoilageAo";
$route['admin/menu/spoilages'] = "adminview/viewspoilagesmenu";
$route['admin/addons/spoilages'] = "adminview/viewspoilagesaddons";
$route['admin/log/stocks'] = "adminview/viewLogStock";
$route['admin/log/activity'] = "adminview/viewActivityLog";
// $route['admin/transactions'] = "adminview/viewtransactions";
// $route['admin/transactions/delivery'] = "adminview/viewDeliveryTransactions";
// $route['admin/transactions/purchase'] = "adminview/viewpurchasetransactions";
// $route['admin/transactions/return'] = "adminview/viewreturntransactions";
// $route['admin/transactions/getReturns'] = "adminview/getReturns";
$route['admin/stocklog/report'] = "adminview/getInventoryReport";
$route['admin/purchaseorder'] = "adminview/viewPurchaseOrder";
$route['admin/deliveryreceipt'] = "adminview/viewDeliveryReceipt";
$route['admin/officialreceipt'] = "adminview/viewOfficialReceipt";
$route['admin/return'] = "adminview/viewReturn";
$route['admin/consumption'] = "adminview/viewConsumptions";
$route['admin/stock/spoilages'] = "adminview/viewSpoilagesstock";
$route['admin/purchaseorder/formadd'] = "adminview/viewPOFormAdd";
$route['admin/purchaseorder/formedit'] = "adminview/viewPOFormEdit";
$route['admin/deliveryreceipt/formadd'] = "adminview/viewDRFormAdd";
$route['admin/deliveryreceipt/formedit'] = "adminview/viewDRFormEdit";
$route['admin/officialreceipt/formadd'] = "adminview/viewORFormAdd";
$route['admin/officialreceipt/formedit'] = "adminview/viewORFormEdit";

//End Viewing Routes

//Not Sure Routes
$route['admin/menu/datatables'] = "adminview/datatables_menu";
//End Note Sure Routes

//Admin Add Routes ----------------------------------------------
$route['admin/transactions/add'] = "adminadd/addtransaction";
$route['admin/purchaseorder/add'] = "adminadd/addPurchaseOrder";
$route['admin/inventory/addEdit'] = "adminadd/addstockitem";
$route['admin/menu/add'] = "adminadd/addMenu";
$route['admin/measurement/add'] = "adminadd/addUOM";
$route['admin/menu/image/add'] = "adminadd/addImage";
$route['admin/addon/add'] = "adminadd/addAddon";
$route['admin/stockcategories/add'] = "adminadd/addstockcategory";
$route['admin/menucategories/add'] = "adminadd/addmenucategory";
$route['admin/sales/add'] = "adminadd/addSales";
$route['admin/submenucategories/add'] = "adminadd/addsubmenucategory";
$route['admin/substockcategories/add'] = "adminadd/addsubstockcategory";
$route['admin/accounts/add'] = "adminadd/addaccounts";
$route['admin/tables/add'] = "adminadd/addtable";
$route['admin/addons/spoilages/add'] = "adminadd/addspoilagesaddons";
$route['admin/stock/spoilages/add'] = "adminadd/addspoilagesstock";
$route['admin/menu/spoilages/add'] = "adminadd/addspoilagesmenu";
$route['admin/supplier/add'] = "adminadd/addSupplierMerchandise";
$route['admin/returns/add'] = "adminadd/addReturnTransactions";
$route['admin/promos/add'] = "adminadd/addPromo";
$route['admin/consumption/add'] = "adminadd/addConsumption";
$route['admin/stocklog/report/add'] = "adminadd/addInventoryReport";
$route['admin/returns/add'] = "adminadd/addReturns";
$route['admin/stocklog/ending/add'] = "adminadd/addBeginningLogs";
//End Admin Add Routes ------------------------------------------

//Admin Update Routes -------------------------------------------
$route['admin/menucategories/edit'] = "adminupdate/editmenucategory/";
$route['admin/stockcategories/edit'] = "adminupdate/editstockcategory/";
$route['admin/menu/edit'] = "adminupdate/editmenu";
$route['admin/addon/edit'] = "adminupdate/editAddon";
$route['admin/measurement/edit'] = "adminupdate/editMeasurement";
$route['admin/menu/edit_image'] = "adminupdate/edit_image";
$route['admin/inventory/edit'] = "adminupdate/editstockitem";
$route['admin/purchaseorder/edit'] = "adminupdate/editPurchaseOrder";
$route['admin/transactions/edit'] = "adminupdate/edittransactions";
$route['admin/accounts/changepassword'] = "adminupdate/changeAccountPassword";
$route['admin/accounts/edit'] = "adminupdate/editAccounts";
$route['admin/supplier/edit'] = "adminupdate/editSupplierMerchandise";
$route['admin/sales/edit'] = "adminupdate/editSales";
$route['admin/stockqty/edit'] = "adminupdate/editStockQty";
$route['admin/stock/spoilage/edit'] = "adminupdate/editStockSpoil";
$route['admin/tables/edit'] = "adminupdate/edittable";
$route['admin/menu/spoilage/edit'] = "adminupdate/editMenuSpoil";
$route['admin/addons/spoilage/edit'] = "adminupdate/editAoSpoil";
$route['admin/returns/edit'] = "adminupdate/editReturns";
//End Admin Update Routes ---------------------------------------

//Admin Delete Routes -------------------------------------------
$route['admin/tables/delete'] = "admindelete/deletetable";
$route['admin/addons/delete/(:num)'] = "admindelete/deleteaddon/$1";
$route['admin/menucategories/delete/(:num)'] = "admindelete/deletemenucategory/$1";
$route['admin/menu/delete/(:num)'] = "admindelete/deletemenu/$1";
$route['admin/stockcategories/delete/(:num)'] = "admindelete/deletestockcategory/$1";
$route['admin/inventory/delete/(:num)'] = "admindelete/deletestockitem/$1";
$route['admin/measurement/delete/(:num)'] = "admindelete/deleteMeasurement/$1";
$route['admin/transactions/delete'] = "admindelete/deletetransactions";
$route['admin/source/delete/(:num)'] = "admindelete/deletesource/$1";
$route['admin/stock/spoilage/delete'] ="admindelete/deletestockspoilages";
$route['admin/menu/spoilage/delete/(:num)'] ="admindelete/deletemenuspoilages/$1";
$route['admin/addons/spoilage/delete/(:num)'] ="admindelete/deleteaddonsspoilages/$1";
$route['admin/accounts/delete'] ="admindelete/deleteAccount";

//End Admin Delete Routes ---------------------------------------

//Admin Json Routes ------------------------------------------- 
$route['admin/logJson'] = "adminview/jsonLogStock";
$route['admin/activitylog'] = "adminview/jsonActivityLogs";
$route['admin/jsonStock'] = "adminview/jsonStock";
$route['admin/jsonPromos'] = "adminview/jsonPromos";
$route['admin/spoilagesmenujson'] = "adminview/viewSpoilagesMenuJs";
$route['admin/spoilagesaddonsjson'] = "adminview/viewSpoilagesAddonsJs";
$route['admin/spoilagesstockjson'] = "adminview/viewSpoilagesStockJs";
$route['admin/accounts/viewAccountsJs'] ="adminview/viewAccountsJs";
$route['admin/jsonMenu'] ="adminview/jsonMenu";
$route['admin/stock/spoilages/viewStockJS'] ="adminview/viewStockJS";
$route['admin/menu/spoilages/viewMenuJS'] ="adminview/viewMenuJS";
$route['admin/addon/spoilages/viewAddonJS'] ="adminview/viewAddonJS";
$route['admin/jsonPOrders'] ="adminview/jsonPurchaseOrders";
$route['admin/jsonSupp'] ="adminview/jsonSuppliers";
$route['admin/jsonMerchandise'] ="adminview/jsonSuppMerchandise";
$route['admin/jsonSales'] ="adminview/jsonSales";
$route['admin/jsonPrefDetails'] ="adminview/jsonPrefDetails";
$route['admin/inventory/getitem'] = "adminview/getStockDetails";
$route['admin/getPurchaseOrders'] = "adminview/getPurchaseOrders";
$route['admin/jsonAddons'] = "adminview/jsonMenuAddons";
$route['admin/inventory/getEnumVals'] = "adminview/getEnumValsForStock";
$route['admin/inventory/getStockItem'] = "adminview/getStockItem";
$route['admin/transactions/getEnumVals'] = "adminview/getEnumValsForTransaction";
$route['admin/transactions/getTransaction'] = "adminview/getTransaction";
$route['admin/transactions/getPOs'] = "adminview/getPOs";
$route['admin/transactions/getDRs'] = "adminview/getDRs";
$route['admin/transactions/getSPMs'] = "adminview/getSPMs";
$route['admin/inventory/getStockItems'] = "adminview/getStockItems";
$route['admin/inventory/restock'] = "adminadd/addRestockLog";
$route['admin/jsonReturns'] = "adminview/jsonReturns";
$route['admin/jsonPO'] = "adminview/jsonPO";

$route['admin/menu/getMenuStockModalData'] = "adminview/getMenuStockModalData";
$route['admin/menu/addMenuStock'] = "adminadd/addMenuStock";
$route['admin/inventory/getStocksForBeginningBrochure'] = "adminview/getStocksForBeginningBrochure";
//End Admin Json Routes ---------------------------------------

//CUSTOMER ROUTES
$route['customer/processCheckIn'] = "customer/processCheckIn";
$route['customer/promos'] = "customer/promos";
$route['customer/freebies_discounts'] = "customer/freebies_discounts";
$route['customer/freebies'] = "customer/freebies";
$route['customer/menu/vieworders'] = "customer/viewOrders";
$route['customer/menu/addOrder'] = "customer/addOrder";
$route['customer/checkout'] = "customer/checkout";
$route['customer/checkin'] = 'customer/checkIn';
$route['customer/menu'] = "customer/view";
$route['customer/json'] = "customer/json";
$route['customer/menu/removeOrder'] = "customer/removeOrder";
$route['customer/menu/editOrder'] = "customer/editOrder";

// BARISTA ROUTES
$route['barista/orderslip'] = "barista/vieworderslip";
$route['barista/orders'] = "barista/pendingOrders";
$route['barista/servedOrderlist'] = "barista/servedOrders";
$route['barista/billings'] = "barista/getOrderBills";
$route['barista/getBillDetails'] = "barista/getBillDetails";
$route['barista/billings/setStatus'] = "barista/setbillstatus";
$route['barista/inventory'] = "barista/viewinventory";
$route['barista/inventoryJS'] = "barista/inventoryJS";
$route['barista/restock'] = "barista/restockitem";
$route['barista/destock'] = "barista/destockitem";
$route['barista/updateStatus'] = "barista/updateStatus";

//BARISTA JS ROUTES
// $route['barista/orderslipJS'] = "barista/viewOrderslipJS";
// $route['barista/pendingOrdersJS'] ="barista/pendingOrdersJS";

// CHEF ROUTES
$route['chef'] = "chef/index";
$route['chef/orders'] = "chef/get_orderlist";
$route['chef/inventory'] = "chef/viewInventory";
$route['chef/change_status'] = "chef/change_status";
$route['chef/inventoryJS'] = "chef/inventoryJS";
$route['chef/viewStockJS'] ="chef/viewStockJS";
$route['chef/viewMenuJS'] ="chef/viewMenuJS";
$route['chef/spoilagesmenujson'] = "chef/viewSpoilagesMenuJs";
$route['chef/spoilagesstockjson'] = "chef/viewSpoilagesStockJs";
$route['chef/spoilages/menu'] = "chef/viewSpoilagesMenu";
$route['chef/spoilages/menu/add'] = "chef/addspoilagesmenu";
$route['chef/spoilages/menu/edit'] = "chef/editMenuSpoil";
$route['chef/spoilages/stock'] = "chef/viewSpoilagesStock";
$route['chef/spoilages/stock/add'] = "chef/addspoilagesstock";
$route['chef/spoilages/stock/edit'] = "chef/editStockSpoil";
$route['chef/spoilages/stock/delete'] ="chef/deletestockspoilages";
