package destore;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class DBManager {

	String[] productList = new String[] {"Eggs","Milk","Sugar","Onions","Bread"};
	List<Purchase> dbpurchases = new ArrayList<Purchase>();

	public String[] getProductList() {
		return productList;
	}

	public void storePurchase(Purchase purchase) {
		System.out.println("Purchase added to Central DB. ");
		dbpurchases.add(purchase);
	}
	public Purchase[] getAllPurchases() {
		Purchase[] r = new Purchase[dbpurchases.size()];
		for (int i=0; i<dbpurchases.size(); i++) {
			r[i]=dbpurchases.get(i);
		}
		return r;
	}
	
}
