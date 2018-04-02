package spacegame.ui;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import spacegame.Game;
import spacegame.Space;

import javax.swing.SpringLayout;
import java.awt.Button;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.JLabel;

public class GameUI extends JFrame {
	private Game game;
	private JPanel contentPane;
	private UICanvas canvas;
	private JLabel labelBM;
	private JLabel labelCharge;
	private Button button2;
	private Button button;
	private JLabel labelTimer;

	public GameUI(Game game) {
		this.game = game;
		canvas = new UICanvas(game.getSpace());
		canvas.setBackground(Color.black);
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(200, 150, 625, 400);
		
		setMinimumSize(new Dimension(600, 400));
		
		initComponents();
		
	}

	private void initComponents() {
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		SpringLayout layout = new SpringLayout();
		
		layout.putConstraint(SpringLayout.NORTH, canvas, 5, SpringLayout.NORTH, contentPane);
		layout.putConstraint(SpringLayout.WEST, canvas, 5, SpringLayout.WEST, contentPane);
		layout.putConstraint(SpringLayout.SOUTH, canvas, -5, SpringLayout.SOUTH, contentPane);
		contentPane.setLayout(layout);
		
		button = new Button("Next Turn");
		layout.putConstraint(SpringLayout.SOUTH, button, -10, SpringLayout.SOUTH, contentPane);
		layout.putConstraint(SpringLayout.EAST, button, -1, SpringLayout.EAST, contentPane);
		button.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				button1Action();
			}
		});
		contentPane.add(button);
		contentPane.add(canvas);
		
		button2 = new Button("Attack");
		button2.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				button2Action();
			}
		});
		contentPane.add(button2);
		
		labelBM = new JLabel("OFF");
		layout.putConstraint(SpringLayout.SOUTH, labelBM, 0, SpringLayout.SOUTH, button2);
		layout.putConstraint(SpringLayout.EAST, labelBM, -6, SpringLayout.WEST, button2);
		contentPane.add(labelBM);
		
		labelCharge = new JLabel("1/1");
		layout.putConstraint(SpringLayout.NORTH, labelBM, 0, SpringLayout.NORTH, labelCharge);
		layout.putConstraint(SpringLayout.NORTH, button2, -5, SpringLayout.NORTH, labelCharge);
		layout.putConstraint(SpringLayout.EAST, button2, -6, SpringLayout.WEST, labelCharge);
		layout.putConstraint(SpringLayout.NORTH, labelCharge, 18, SpringLayout.NORTH, contentPane);
		layout.putConstraint(SpringLayout.EAST, labelCharge, 0, SpringLayout.EAST, button);
		contentPane.add(labelCharge);
		
		Button button_1 = new Button("Undo");
		layout.putConstraint(SpringLayout.EAST, canvas, -6, SpringLayout.WEST, button_1);
		layout.putConstraint(SpringLayout.SOUTH, button_1, 0, SpringLayout.SOUTH, button);
		layout.putConstraint(SpringLayout.EAST, button_1, -6, SpringLayout.WEST, button);
		button_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				buttonUndoAction();
			}
		});
		contentPane.add(button_1);
		
		JLabel lblTime = new JLabel("Time:");
		layout.putConstraint(SpringLayout.WEST, lblTime, 6, SpringLayout.EAST, canvas);
		layout.putConstraint(SpringLayout.SOUTH, lblTime, -6, SpringLayout.NORTH, button);
		contentPane.add(lblTime);
		
		labelTimer = new JLabel("0");
		layout.putConstraint(SpringLayout.NORTH, labelTimer, 0, SpringLayout.NORTH, lblTime);
		layout.putConstraint(SpringLayout.WEST, labelTimer, 0, SpringLayout.WEST, button);
		layout.putConstraint(SpringLayout.EAST, labelTimer, 0, SpringLayout.EAST, button2);
		contentPane.add(labelTimer);
		
	}
	
	public void setLabelTimer(int value){
		labelTimer.setText(value+"s");
	}
	public void setLabelBM(String text){
		labelBM.setText(text);
	}
	public String getLabelBM(){
		return labelBM.getText();
	}
	public void setLabelCharge(int charge, int maxCharge){
		labelCharge.setText(charge+"/"+maxCharge);
	}
	public void enableChargeBtn(){
		button2.setEnabled(true);
	}
	public void disableChargeBtn(){
		button2.setEnabled(false);
	}
	public void enableTurnBtn(){
		button.setEnabled(true);
	}
	public void disableTurnBtn(){
		button.setEnabled(false);
	}

	protected void button2Action() {
		game.battleModeButton();
	}

	protected void button1Action() {
		game.goNextTurn();
		setLabelCharge(game.getSpace().getPlayer().getCharge(), game.getSpace().getPlayer().getMaxCharge());
		canvas.repaint();
	}
	protected void buttonUndoAction() {
		game.undoTurn();
	}
	public void repaint(){
		canvas.repaint();
	}
}
