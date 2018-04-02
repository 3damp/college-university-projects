package destore;

import java.io.Serializable;

public class Purchase implements Serializable{
	private static final long serialVersionUID = 1L;
	
	
	private int buyerID;
	private String items;
	private int shopID;
	
	public Purchase(int buyer, String string, int shopID) {
		this.setBuyer(buyer);
		this.setItems(string);
		this.setShopID(shopID);
	}

	public int getBuyer() {
		return buyerID;
	}

	public void setBuyer(int buyer) {
		this.buyerID = buyer;
	}

	public String getItems() {
		return items;
	}

	public void setItems(String string) {
		this.items = string;
	}

	public int getShopID() {
		return shopID;
	}

	public void setShopID(int shopID) {
		this.shopID = shopID;
	}
	@Override
	public String toString() {
		return "Buyer: "+buyerID+", Shop: "+shopID+" Items: "+items;
	}

}
