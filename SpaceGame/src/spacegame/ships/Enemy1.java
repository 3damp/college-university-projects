package spacegame.ships;

import java.util.Random;

import spacegame.Position;

public class Enemy1 extends Enemy {

	public Enemy1(int x, int y) {
		super(x, y);
		name = "Enemy1";
	}

	@Override
	protected Position getNextPosition() {
		Position temp = new Position();
		Random rnd = new Random();
		
		int x=0,y=0,t=1;
		if(rnd.nextBoolean())t=-t;
		if(rnd.nextBoolean())x=t;
		else y=t;
		
		temp.set(
				position.getX()+ x,
				position.getY()+ y);
		return temp;
	}

	@Override
	public int getImage() {
		if(isAlive())return 2;
		else return 0;
	}

	@Override
	protected Enemy1 getCopy() {
		return new Enemy1(0,0);
	}

}
