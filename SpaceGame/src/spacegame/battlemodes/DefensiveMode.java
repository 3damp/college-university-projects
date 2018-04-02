package spacegame.battlemodes;

import java.util.Random;

import spacegame.Position;

public class DefensiveMode implements BattleMode {

	@Override
	public int getStrength() {
		return 1;
	}

	@Override
	public byte getType() {
		return DEFENSIVE;
	}

	@Override
	public Position getNewPosition(Position position) {
		Position temp = new Position();
		Random rnd = new Random();
		
		int x=1,y=1;
		if(rnd.nextBoolean())x=-x;
		if(rnd.nextBoolean())y=-y;
		if(rnd.nextBoolean()){
			if(rnd.nextBoolean())x=0;
			else y=0;
		}
		
		temp.set(
				position.getX()+ x,
				position.getY()+ y);
		return temp;
	}

}
