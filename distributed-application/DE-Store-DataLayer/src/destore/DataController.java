package destore;

public class DataController {

	private DBManager dbmgr;

	// Constructor
	public DataController(DBManager dbmgr) {
		this.dbmgr = dbmgr;
		
//		dbmgr.storePurchase(new Purchase(1,"Milk",1));
		
		
	}
	
	public String[] getProducts() {
		return dbmgr.getProductList();
	}

	public void storePurchase(Purchase purchase) {
		dbmgr.storePurchase(purchase);
	}
	
	public Purchase[] getAllPurchases() {
		System.out.println("All Purchases retrieved from DB");
		return dbmgr.getAllPurchases();
	}

}
