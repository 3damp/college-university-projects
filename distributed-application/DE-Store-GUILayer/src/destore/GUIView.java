package destore;

import java.awt.Label;

import javax.swing.JFrame;
import javax.swing.SpringLayout;

import destore.ui.SalesWindow;
import destore.ui.PurchaseWindow;

import java.awt.event.ActionListener;
import java.awt.event.ItemListener;
import java.util.List;
import java.awt.Button;
import java.awt.TextField;
import java.awt.Choice;
import java.awt.TextArea;

public class GUIView {

	private JFrame frame;
	
	private Button btnEditProduct;
	private Button btnViewSales;
	private Button btn3;

	private SalesWindow salesWin;
	private PurchaseWindow purchaseWin;

	private Choice choiceProducts;

	private TextField tfQuantity;

	private TextField tfPrice;

	private Button btnAnalysisGeneral;

	private TextArea textArea;

	public GUIView() {
		initialize();
		frame.setVisible(true);
	}

	private void initialize() {
		frame = new JFrame();
		frame.setResizable(false);
		frame.setBounds(100, 100, 658, 461);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		SpringLayout springLayout = new SpringLayout();
		frame.getContentPane().setLayout(springLayout);
		
		btnEditProduct = new Button("Edit Product");
		springLayout.putConstraint(SpringLayout.SOUTH, btnEditProduct, -47, SpringLayout.SOUTH, frame.getContentPane());
		frame.getContentPane().add(btnEditProduct);
		
		btnViewSales = new Button("View sales");
		springLayout.putConstraint(SpringLayout.WEST, btnViewSales, 34, SpringLayout.WEST, frame.getContentPane());
		springLayout.putConstraint(SpringLayout.WEST, btnEditProduct, 0, SpringLayout.WEST, btnViewSales);
		springLayout.putConstraint(SpringLayout.NORTH, btnViewSales, 29, SpringLayout.NORTH, frame.getContentPane());
		frame.getContentPane().add(btnViewSales);
		
		btn3 = new Button("AddPurchase");
		springLayout.putConstraint(SpringLayout.NORTH, btn3, 0, SpringLayout.NORTH, btnViewSales);
		springLayout.putConstraint(SpringLayout.WEST, btn3, 6, SpringLayout.EAST, btnViewSales);
		frame.getContentPane().add(btn3);
		
		choiceProducts = new Choice();
		springLayout.putConstraint(SpringLayout.WEST, choiceProducts, 0, SpringLayout.WEST, btnEditProduct);
		springLayout.putConstraint(SpringLayout.SOUTH, choiceProducts, -6, SpringLayout.NORTH, btnEditProduct);
		springLayout.putConstraint(SpringLayout.EAST, choiceProducts, 0, SpringLayout.EAST, btn3);
		frame.getContentPane().add(choiceProducts);
		
		Label labelQuan = new Label("Quantity:");
		springLayout.putConstraint(SpringLayout.NORTH, labelQuan, 0, SpringLayout.NORTH, choiceProducts);
		springLayout.putConstraint(SpringLayout.WEST, labelQuan, 6, SpringLayout.EAST, choiceProducts);
		springLayout.putConstraint(SpringLayout.EAST, labelQuan, -398, SpringLayout.EAST, frame.getContentPane());
		frame.getContentPane().add(labelQuan);
		
		tfQuantity = new TextField();
		springLayout.putConstraint(SpringLayout.WEST, tfQuantity, 0, SpringLayout.EAST, labelQuan);
		springLayout.putConstraint(SpringLayout.SOUTH, tfQuantity, 0, SpringLayout.SOUTH, choiceProducts);
		springLayout.putConstraint(SpringLayout.EAST, tfQuantity, -342, SpringLayout.EAST, frame.getContentPane());
		frame.getContentPane().add(tfQuantity);
		
		Label labelPrice = new Label("Price");
		springLayout.putConstraint(SpringLayout.WEST, labelPrice, 30, SpringLayout.EAST, tfQuantity);
		springLayout.putConstraint(SpringLayout.SOUTH, labelPrice, 0, SpringLayout.SOUTH, choiceProducts);
		springLayout.putConstraint(SpringLayout.EAST, labelPrice, -281, SpringLayout.EAST, frame.getContentPane());
		frame.getContentPane().add(labelPrice);
		
		tfPrice = new TextField();
		springLayout.putConstraint(SpringLayout.WEST, tfPrice, 6, SpringLayout.EAST, labelPrice);
		springLayout.putConstraint(SpringLayout.SOUTH, tfPrice, 0, SpringLayout.SOUTH, choiceProducts);
		springLayout.putConstraint(SpringLayout.EAST, tfPrice, -226, SpringLayout.EAST, frame.getContentPane());
		frame.getContentPane().add(tfPrice);
		
		btnAnalysisGeneral = new Button("General Analysis");
		springLayout.putConstraint(SpringLayout.NORTH, btnAnalysisGeneral, 0, SpringLayout.NORTH, btnViewSales);
		springLayout.putConstraint(SpringLayout.WEST, btnAnalysisGeneral, 6, SpringLayout.EAST, btn3);
		frame.getContentPane().add(btnAnalysisGeneral);
		
		textArea = new TextArea();
		springLayout.putConstraint(SpringLayout.NORTH, textArea, 22, SpringLayout.SOUTH, btnViewSales);
		springLayout.putConstraint(SpringLayout.WEST, textArea, 34, SpringLayout.WEST, frame.getContentPane());
		springLayout.putConstraint(SpringLayout.SOUTH, textArea, 243, SpringLayout.SOUTH, btnViewSales);
		springLayout.putConstraint(SpringLayout.EAST, textArea, -37, SpringLayout.EAST, frame.getContentPane());
		frame.getContentPane().add(textArea);
		
		
		purchaseWin = new PurchaseWindow(frame);
		salesWin = new SalesWindow();
	}

	
	// Listeners #######
	public void addListenerToEditProduct(ActionListener aListener) {
		btnEditProduct.addActionListener(aListener);
	}
	public void addListenerToViewSales(ActionListener aListener) {
		btnViewSales.addActionListener(aListener);
	}
	public void addListenerToButton3(ActionListener aListener) {
		btn3.addActionListener(aListener);
	}
	
	public void addListenerToSubmitPurchase(ActionListener aListener) {
		purchaseWin.addListenerToButton1(aListener);
	}
	public void addListenerToChoiceProducts(ItemListener aListener) {
		choiceProducts.addItemListener(aListener);
	}
	public void addListenerToAddProductSales(ActionListener aListener) {
		salesWin.addListenerToAdd(aListener);
	}
	public void addListenerToRemoveProductSales(ActionListener aListener) {
		salesWin.addListenerToRemove(aListener);
	}
	public void addListenerToAnalysisGeneral(ActionListener aListener) {
		btnAnalysisGeneral.addActionListener(aListener);
	}
	// #################
	
	
	public void showSalesWindow(String[] productsList) {
		//productWin = new ProductsWindow(productsList);
		salesWin.loadProducts(productsList);
		salesWin.setVisible(true);
	}

	public void showPurchaseWindow(String[] products) {
		//purchaseWin = new PurchaseWindow(frame);
		purchaseWin.loadProducts(products);
		purchaseWin.setVisible(true);
		//frame.setVisible(false);		
	}

	public int getBuyer() {
		int result = -1;
		String s = purchaseWin.getBuyer();
		try {
			result = Integer.parseInt(s);
		} catch (Exception e) {
			System.out.println("ERROR: Non-integer entered!");
		}
		return result;
	}

	public String getItems() {
		return purchaseWin.getItems();
	}

	public int getShop() {
		int result = -1;
		String s = purchaseWin.getShop();
		try {
			result = Integer.parseInt(s);
		} catch (Exception e) {
			System.out.println("ERROR: Non-integer entered!");
		}
		return result;
	}

	public void cleanPurchaseForm() {
		purchaseWin.cleanForm();
		
	}

	public void hidePurchaseWindow() {
		purchaseWin.setVisible(false);
	}
	
	public void loadProductList(String[] prods) {
		for (String item : prods) {
			choiceProducts.add(item);
		}
	}

	public void setQuantity(int quantity) {
		tfQuantity.setText(""+quantity);
	}
	
	public int getQuantity() {
		try {
			return Integer.parseInt(tfQuantity.getText());
		} catch (Exception e) {
			return 0;
		}
	}

	public float getPrice() {
		try {
			return Float.parseFloat(tfPrice.getText());
		} catch (Exception e) {
			return 0;
		}
	}
	
	public void setPrice(float price) {
		tfPrice.setText(price+"");
	}
	
	public String getSelectedProduct() {
		return choiceProducts.getSelectedItem();
	}
	public String getSelectedProductSales() {
		return salesWin.choiceProduct.getSelectedItem();
	}
	public String getSelectedOfferTypeSales() {
		return salesWin.choiceOfferType.getSelectedItem();
	}
	public int getSelectedSaleIndexSales() {
		return salesWin.listSales.getSelectedIndex();
	}
	public void loadSales(List sales) {
		salesWin.loadSales(sales);
	}
	public void setTextArea(String text) {
		textArea.setText(text);
	}
}
