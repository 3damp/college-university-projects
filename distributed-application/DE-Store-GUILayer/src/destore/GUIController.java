package destore;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import javax.swing.JFrame;
import javax.swing.JOptionPane;

public class GUIController {

	private GUIView view;
	private GUIModel model;
	
	public GUIController(GUIModel model, GUIView view) {
		this.view = view;
		this.model = model;
		
		view.addListenerToEditProduct(new EditProductListener());
		view.addListenerToViewSales(new ViewSalesListener());
		view.addListenerToButton3(new AddPurchaseListener());
		view.addListenerToSubmitPurchase(new SubmitPurchaseListener());
		view.addListenerToChoiceProducts(new ChoiceListener());
		view.loadProductList(model.getProductList());
		view.addListenerToAddProductSales(new AddSaleListener());
		view.addListenerToRemoveProductSales(new RemoveSaleListener());
		view.addListenerToAnalysisGeneral(new AnalysisGeneralListener());
		
		updateFields();
	}
	
	
	private void updateFields() {
		view.setQuantity(model.getQuantity(view.getSelectedProduct()));
		view.setPrice(model.getPrice(view.getSelectedProduct()));
	}


	// Listeners _____________
	
	//Edit Product button
	class EditProductListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			model.editProduct(view.getSelectedProduct(),view.getQuantity(),view.getPrice());
		}
	}
	//Show Products button
	class ViewSalesListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			view.showSalesWindow(model.getProductList());
		}
	}
	//Add purchase button
	class AddPurchaseListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			view.showPurchaseWindow(model.getProductList());
		}
	}
	//Submit purchase button
	class SubmitPurchaseListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			//Read values
			Purchase purchase = new Purchase(view.getBuyer(), view.getItems(), view.getShop());
			
			// invalid values
			if(purchase.getBuyer()<0||purchase.getShopID()<0) {
				JOptionPane.showMessageDialog(new JFrame(),
					    "Buyer and Shop values must be positive integers.",
					    "Invalid Values",
					    JOptionPane.WARNING_MESSAGE);
			// valid values
			}else { 
				view.cleanPurchaseForm();
				view.hidePurchaseWindow();
				//System.out.println(purchase);
				model.sendPurchase(purchase);
				view.setQuantity(model.getQuantity(view.getSelectedProduct()));
			}
		}
	}
	//Add purchase button
	class ChoiceListener implements ItemListener{
		@Override
		public void itemStateChanged(ItemEvent e) {
			view.setQuantity(model.getQuantity(e.getItem().toString()));
			view.setPrice(model.getPrice(e.getItem().toString()));
		}
	}
	//Add sale button
	class AddSaleListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			String prod = view.getSelectedProductSales();
			String offerType = view.getSelectedOfferTypeSales();
			model.saveOffer(prod, offerType);
			view.loadSales(model.getSales());
		}
	}
	//Remove sale button
	class RemoveSaleListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			model.removeOffer(view.getSelectedSaleIndexSales());
			view.loadSales(model.getSales());
		}
	}
	//Analysis button
	class AnalysisGeneralListener implements ActionListener{
		public void actionPerformed(ActionEvent e) {
			view.setTextArea(model.analysisGeneric());
		}
	}
		
}
