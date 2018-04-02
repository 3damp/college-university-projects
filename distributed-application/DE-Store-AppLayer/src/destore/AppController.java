package destore;

import java.util.HashMap;
import java.util.Map;

public class AppController {
	private AppDataConnection dataLayer;
	
	// Constructor
	public AppController(AppDataConnection dConnection) {
		this.dataLayer = dConnection;
		
		//System.out.println(analysisGeneric());
	}
	
	public String[] getProducts() {
		return dataLayer.getProductList(); 	
	}

	public void requestSupplies(int shop, String product, int quantity) {
		System.out.println("Supplies requested from shop \""+shop+"\": "+product+" x"+quantity);
	}

	public void sendPurchaseToServer(Purchase purchase) {
		System.out.println("Purchase passed to Data Layer.");
		dataLayer.sendPurchaseToServer(purchase);
	}
	
	public String analyseStore(int id) {
		
		return "a";
	}
	public String analysisGeneric() {
		System.out.println("Purchases processed and passed to GUI layer.");
		String result = "____ TOTAL ____\n";
		Purchase[] ps = dataLayer.getAllPurchases();
		String[] prods = dataLayer.getProductList();
		Map<Integer,Integer> shops = new HashMap<Integer,Integer>();
		if(ps.length>0) {
			for (String prod : prods) {
				int sold = 0;
				for (Purchase p : ps) {
					if(p.getItems().equals(prod)) {
						sold++;
					}
				}
				result = result+(prod+ ": \t"+ sold + " items sold.\n");
			}
			// count purchases per shop
			for (Purchase p : ps) {
				int id = p.getShopID();
				int count = 1;
				if(shops.containsKey(id)) {
					count += shops.get(id);
				}
				shops.put(id, count);
			}
			result = result + "\n____ SHOPS ____\n";
			for (Map.Entry<Integer, Integer> shop : shops.entrySet()) {
				result = result + "Shop "+shop.getKey()+" made "+ shop.getValue()+ " sales.\n";
			}
			
		}else {
			result = "There are no purchases.";
		}
		return result;
	}
	
	 
	
}
