package spacegame.ui;

import java.awt.Canvas;
import java.awt.Color;
import java.awt.Graphics;
import java.awt.Image;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Iterator;

import javax.imageio.ImageIO;

import spacegame.Space;
import spacegame.ships.Ship;

public class UICanvas extends Canvas{

	int columns;
	int rows;
	int posX 	= 1;
	int posY 	= 1;
	
	private static final int MARGIN = 10;
	private static final float REDUCTION = 0.004f;
	int cellX,cellY;
	float scale;
	
	private Graphics g;
	private ArrayList<Image> img;
	private Space space;	
	
	public UICanvas(Space space) {
		img = new ArrayList<Image>();
		this.space = space;
		this.columns = space.getWidth();
		this.rows = space.getHeight();
		initImages();
	}
	
	private void initImages() {
		try {			
			img.add(ImageIO.read(getClass().getResource("/dead.png"))); 			//0
			img.add(ImageIO.read(getClass().getResource("/player.png"))); 			//1
			img.add(ImageIO.read(getClass().getResource("/enemy01.png"))); 			//2
			img.add(ImageIO.read(getClass().getResource("/enemy02.png"))); 			//3
			img.add(ImageIO.read(getClass().getResource("/enemy03.png"))); 			//4
			img.add(ImageIO.read(getClass().getResource("/playerOffensive.png"))); 	//5
		} catch (IOException e) {
			System.out.println("ERROR loading images");
			e.printStackTrace();
		}
	}

	@Override
	public void paint(Graphics g) {
		this.g = g;
		calculateScale();
		
		//clear canvas
		g.setColor(new Color(0f,0f,0f));
		g.fillRect(0, 0, getWidth(), getHeight());
		
		drawGrid();
		drawShips();
	}
	
	
	private void drawShips() {
		for(Ship ship:space.getShips()){
			drawShip(img.get(ship.getImage()),ship.getPosition().getX(),ship.getPosition().getY());
		}
	}
	
	private void drawShip(Image img,int column,int row){
		g.drawImage(img,
				(int) (MARGIN+column*cellX + Math.random()*(cellX-MARGIN*2-img.getWidth(null)*scale)),
				(int) (MARGIN+row*cellY  + Math.random()*(cellY-MARGIN*2-img.getHeight(null)*scale)),
				(int)(img.getWidth(null)*scale),
				(int)(img.getHeight(null)*scale),
				null);
	}
	
	private void drawGrid(){
		g.setColor(new Color(0.2f,0.2f,0.2f));
		for(int i=0;i<columns-1;i++){
			g.drawLine(cellX+i*cellX, 0, cellX+i*cellX, getHeight());
		}
		for(int i=0;i<rows-1;i++){
			g.drawLine(0, cellY+i*cellY, getWidth(), cellY+i*cellY);
		}	
	}
	
	private void calculateScale(){
		cellX = getWidth()/columns;
		cellY = getHeight()/rows;
		scale = cellY*REDUCTION;
	}
	
}
