package spacegame;

public class Updater extends Thread{
	Game game;
	public Updater(Game game) {
		this.game = game;
	}

	@Override
	public void run() {
		//int i = 0;
		while(true){
			try {
				sleep(1000);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			game.updateSecond();
		}
		
	}
}
