package spacegame.ships;


import spacegame.battlemodes.BattleMode;
import spacegame.battlemodes.DefensiveMode;
import spacegame.battlemodes.OffensiveMode;
import spacegame.Position;

public class Player extends Ship{
	
	private int maxCharge 	= 1;
	private int charge 		= 1;
	private BattleMode battleMode;
	
	public Player(int x, int y) {
		super(x, y);
		name = "Player";
		image = 1;
		type = PLAYER;
		setDefensiveMode();
	}

	@Override
	protected Position getNextPosition() {
		return battleMode.getNewPosition(position);
	}

	public int getCharge() {
		return charge;
	}
	public void useCharge() {
		if(charge>0) charge--;
	}

	public int getMaxCharge() {
		return maxCharge;
	}
	
	
	public byte getBattleMode() {
		return battleMode.getType();
	}
	public int getStrength() {
		return battleMode.getStrength();
	}
	
	public void setDefensiveMode() {
		this.battleMode = new DefensiveMode();
	}
	public void setOffensiveMode() {
		this.battleMode = new OffensiveMode();
	}

	@Override
	public int getImage(){
		if(isAlive()){
			if(battleMode.getType()==BattleMode.DEFENSIVE){
				return 1;
			}else{
				return 5;
			}
		}
		else return 0;
	}

	public void addCharge() {
		if(charge<maxCharge)charge++;
	}

	@Override
	protected Player getCopy() {
		return new Player(0,0);
	}
	
	

}
