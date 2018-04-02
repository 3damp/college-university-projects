package spacegame.specialactions;

import spacegame.Game;
import spacegame.Space;
import spacegame.ships.Player;

public class ActivateOffensiveMode implements SpecialAction {
	private Space space;
	public ActivateOffensiveMode(Game game) {
		this.space = game.getSpace();
	}
	@Override
	public void execute() {
		Player p = (Player)space.getPlayer();
		p.setOffensiveMode();
	}

}
