package spacegame;

import java.util.ArrayList;
import java.util.Random;

import spacegame.battlemodes.BattleMode;
import spacegame.ships.Ship;
import spacegame.specialactions.ActivateOffensiveMode;
import spacegame.specialactions.DeactivateOffensiveMode;
import spacegame.specialactions.SpecialAction;
import spacegame.turnmanager.TurnManager;
import spacegame.ui.GameUI;

public class Game {

	private Space space;
	private BattleSolver battleSolver;
	private GameUI ui;
	private ArrayList<SpecialAction> specialActions;
	private TurnManager turnManager;
	private Updater updater;
	private int seconds;
	
	public Game() {
		turnManager = new TurnManager();
		battleSolver = new BattleSolver();
		space = new Space(4,4); //init Space with size
		ui = new GameUI(this);
		space.createPlayer();
		specialActions = new ArrayList<SpecialAction>();
		
		//Timer thread
		updater = new Updater(this);
		updater.start();		
		
		ui.setVisible(true);
	}
	
	public void goNextTurn(){
		Random rnd = new Random();
		turnManager.saveTurn(space.getShips());
		
		//Execute special commands
		for(SpecialAction sa:specialActions){
			sa.execute();
		}
		
		space.updateShips();
		
		//Spawn new enemy
		if (rnd.nextInt(3)==0) {
			space.createEnemy();
		}
		
		battleSolver.resolveConflicts(space.getShips());
				
		processCharges();
		
		//Reset commands
		specialActions = new ArrayList<SpecialAction>();
		specialActions.add(new DeactivateOffensiveMode(this));
		//Reset button
		ui.setLabelBM("OFF");
		
		//Check if player is DEAD
		if(!space.getPlayer().isAlive()){
			updater.stop();
			ui.disableTurnBtn();
		}
	}

	private void processCharges() {
		if(space.getPlayer().getBattleMode()==BattleMode.OFFENSIVE){
			if(space.getPlayer().getCharge()>1){
				space.getPlayer().useCharge();
			}else {
				space.getPlayer().useCharge();
				ui.disableChargeBtn();
			}
		}else{
			space.getPlayer().addCharge();
			if(space.getPlayer().getCharge()>0)ui.enableChargeBtn();
		}
	}
	
	
	public void battleModeButton(){
		//Change commands
		if(ui.getLabelBM().equals("OFF")){
			specialActions = new ArrayList<SpecialAction>(); 
			specialActions.add(new ActivateOffensiveMode(this));
			ui.setLabelBM("ON");
		}else{
			specialActions = new ArrayList<SpecialAction>();
			specialActions.add(new DeactivateOffensiveMode(this));
			ui.setLabelBM("OFF");
		}
	}
	
	
	public Space getSpace(){
		return space;
	}
	

	public void undoTurn(){
		ArrayList<Ship> tempShips = turnManager.getLastTurn();
		if(tempShips!=null){
			space.setShips(tempShips);
			ui.repaint();
		}
		ui.enableTurnBtn();
	}
	
	public void updateSecond() {
		ui.setLabelTimer(seconds);
		seconds++;
	}

	
	
}
