package spacegame;

public class Position {
	private int x;
	private int y;
	public Position() {
		x=0;
		y=0;
	}
	public int getX(){
		return x;
	}
	public int getY(){
		return y;
	}
	public void set(int x, int y){
		this.x = x;
		this.y = y;
	}
	public boolean equals(Position p){
		if (this.getX()==p.getX() && this.getY()==p.getY()) {
			return true;
		}
		return false;
	}
}
