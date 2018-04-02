package spacegame.ships;


import spacegame.Position;
import spacegame.Space;

public abstract class Ship {
	public static final int ENEMY = 2;
	public static final int PLAYER = 1;
	
	protected Position position;
	protected boolean alive;
	protected int image;
	protected String name;
	protected int type;
	
	public Ship(int x, int y) {
		position = new Position();
		alive = true;
		position.set(x, y);
		
	}
	
	public void update(Space space){
		Position tempPos = getNextPosition();
		while(!space.isValidPosition(tempPos)){
			tempPos = getNextPosition();
		}
		setPosition(tempPos);
	}
	
	protected abstract Position getNextPosition();

	public Position getPosition() {
		return position;
	}

	public void setPosition(Position position) {
		this.position = position;
	}
	public void destroy(){
		alive = false;
	}
	public int getType(){
		return type;
	}
	public boolean isAlive(){
		return alive;
	}
	public abstract int getImage();
	@Override
	public String toString() {
		return name +this.hashCode()+":("+position.getX()+","+position.getY()+")";
	}
	public Ship copy() {
		Ship s;
		s = getCopy();
		s.setPosition(this.getPosition());
		if(!this.isAlive())s.destroy();
		return s;
	}

	protected abstract Ship getCopy();
}
