import java.awt.geom.Point2D;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;

public class TSP {

	
	
	
	public static ArrayList<Point2D> loadTSPLib(String fName) {
		
		// Load in a TSPLib instance. This example assumes that the Edge weight
		// type
		// is EUC_2D.
		// It will work for examples such as rl5915.tsp. Other files such as
		// fri26.tsp .To use a different format, you will have to
		// modify the this code
		
		ArrayList<Point2D> result = new ArrayList<Point2D>();
		BufferedReader br = null;
		
		try {
			String currentLine;
			int dimension = 0;// Hold the dimension of the problem
			boolean readingNodes = false;
			br = new BufferedReader(new FileReader(fName));
			
			while ((currentLine = br.readLine()) != null) {
				// Read the file until the end;
				if (currentLine.contains("EOF")) {
					// EOF should be the last line
					readingNodes = false;
					// Finished reading nodes
					if (result.size() != dimension) {
						// Check to see if the expected number of cities have
						// been loaded
						System.out.println("Error loading cities");
						System.exit(-1);
					}
				}
				if (readingNodes) {
					// If reading in the node data
					String[] tokens = currentLine.split(" ");
					// Split the line by spaces.
					// tokens[0] is the city id and not needed in this example
					float x = Float.parseFloat(tokens[1].trim());
					float y = Float.parseFloat(tokens[2].trim());
					// Use Java's built in Point2D type to hold a city
					Point2D city = new Point2D.Float(x, y);
					// Add this city into the arraylist
					result.add(city);
				}
				if (currentLine.contains("DIMENSION")) {
					// Note the expected problem dimension (number of cities)
					String[] tokens = currentLine.split(":");
					dimension = Integer.parseInt(tokens[1].trim());
				}
				if (currentLine.contains("NODE_COORD_SECTION")) {
					// Node data follows this line
					readingNodes = true;
				}
			}
			
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			try {
				if (br != null)
					br.close();
			} catch (IOException ex) {
				ex.printStackTrace();
			}
		}
		return result;
	}

	public static double routeLength(ArrayList<Point2D> cities) {
		// Calculate the length of a TSP route held in an ArrayList as a set of
		// Points
		double result = 0;// Holds the route lenth
		Point2D prev = cities.get(cities.size() - 1);
		// Set the previous city to the last city in the ArrayList as we need to
		// measure the length of the entire loop
		for (Point2D city : cities) {
			// Go through each city in turn
			result += city.distance(prev);
			// get distance from the previous city
			prev = city;
			// current city will be the previous city next time
		}
		result += cities.get(0).distance(cities.get(cities.size()-1));
		return result;
	}
	
	
	public static ArrayList<Point2D> getRouteNN(ArrayList<Point2D> cities) {
		ArrayList<Point2D> itinerary = new ArrayList<Point2D>();
		
		if(!(cities.size()>0))return itinerary; //return empty itinerary if cities is empty
		
		double distance;
		Point2D closestCity = null;
		Point2D currentCity = cities.get(0); 

		itinerary.add(currentCity); //set start point
		cities.remove(0); //remove start point from cities
		
		
		while(cities.size()>0){
			distance = 999999999;
			for(Point2D city:cities){
				if(city.distance(currentCity)<distance){
					distance = city.distance(currentCity);
					closestCity = city;
				}
			}
			itinerary.add(closestCity); //add closest city
			cities.remove(closestCity); //remove start point from cities
			currentCity = closestCity;
		}
		
		return itinerary;
	}
	
	
	public static ArrayList<Point2D> refine1(ArrayList<Point2D> coords){
		boolean improved = false; 
		double longestDist = 999999999;
		int counter = 0; //improvements counter
		
		int pointToMove = getSecondPointOfLongestDistance(coords, longestDist);
		int location;		
		
		//Find longest trip
		while((pointToMove = getSecondPointOfLongestDistance(coords, longestDist))>=0){
			improved=false; //reset variable
			int closestToPoint1 = getCloserPoint(coords, pointToMove); 
			
			//If there is a closer point
			if(closestToPoint1>=0){ 
				location = getCloserConnection(coords, pointToMove, closestToPoint1);
				ArrayList<Point2D> tempArray = movePoint((ArrayList<Point2D>) coords.clone(), pointToMove, location);
				
				//Check if total length has been reduced
				if(routeLength(tempArray)<routeLength(coords)){
					//if so
					coords = tempArray; //make change permanent
					improved=true;
					counter++;
				}
			}
			if(!improved){ //If not improved
				//Store last longest trip distance
				longestDist = getLongestDistance(coords, longestDist);
			}else{
				//Reset longest trip distance
				longestDist = 999999999;
			}
		}
		System.out.println("IMPROVEMENTS: "+counter);
		
		return coords;
	}
	
	//Moves a specific point to a different location inside the same array.
	public static ArrayList<Point2D> movePoint(ArrayList<Point2D> coords, int pointToMove, int location) {
		Point2D temp;
		temp = coords.get(pointToMove);
		coords.remove(pointToMove);
		coords.add(location, temp);
		return coords;
	}
	
	//Returns the connected point to SecondPoint which is closer to FirstPoint.
	public static int getCloserConnection(ArrayList<Point2D> itinerary, int firstPoint, int secondPoint){
		int result = -1;
		Point2D firstCity = itinerary.get(firstPoint);
		if(firstCity.distance(itinerary.get(secondPoint-1))<firstCity.distance(itinerary.get(secondPoint+1))){
			return secondPoint;
		}else{
			return secondPoint+1;
		}
	}
	
	//Returns the closest point to “indexPoint” which is not connected to this.
	public static int getCloserPoint(ArrayList<Point2D> itinerary, int indexPoint){
		int result = -1;
		Point2D currentCity = itinerary.get(indexPoint);
		double maxDist = itinerary.get(indexPoint).distance(itinerary.get(indexPoint-1));
		
		if(indexPoint<itinerary.size()-1){
			if(itinerary.get(indexPoint).distance(itinerary.get(indexPoint+1))<maxDist){
				maxDist = itinerary.get(indexPoint).distance(itinerary.get(indexPoint+1));
			}
		}
		for(int i=1; i<itinerary.size(); i++){
			if(itinerary.get(i).distance(currentCity)<maxDist && i!=indexPoint){
				result = i;
				maxDist = itinerary.get(i).distance(currentCity);
			}
		}
		return result;
	}
	
	// Returns the point with longest distance to its previous connection.
	public static int getSecondPointOfLongestDistance(ArrayList<Point2D> itinerary, double maxDist){
		int result = -1;
		double distance = -1;
		double tempDist;
		
		for(int i=1; i<itinerary.size(); i++){
			tempDist = itinerary.get(i).distance(itinerary.get(i-1));
			if(tempDist < maxDist  && tempDist > distance){
				distance = tempDist;
				result = i;
			}
		}
		return result;
	}
	
	//Returns longest trip but not longer than maxDist
	public static double getLongestDistance(ArrayList<Point2D> itinerary, double maxDist){
		int result = -1;
		double distance = -1;
		double tempDist;
		
		for(int i=1; i<itinerary.size(); i++){
			tempDist = itinerary.get(i).distance(itinerary.get(i-1));
			if(tempDist < maxDist  && tempDist > distance){
				distance = tempDist;
				result = i;
			}
		}
		return distance;
	}
	
	public static ArrayList<Point2D> getRouteNNMod(ArrayList<Point2D> cities) {
		ArrayList<Point2D> itinerary = new ArrayList<Point2D>();
		
		if(!(cities.size()>0))return itinerary; //return empty itinerary if cities is empty
		
		
		double distance;
		double tempDistance;
		double prevDistance;
		
		Point2D closestCity = null;
		Point2D closestCity2 = null;
		Point2D currentCity = cities.get(0); 

		itinerary.add(currentCity); //set start point
		cities.remove(0); //remove start point from cities
		
		prevDistance = 999999999;
		
		while(cities.size()>0){
			distance = 999999999;
			
			//Search for closest city
			for(Point2D city:cities){
				if(city.distance(currentCity)<distance){
					distance = city.distance(currentCity);
					closestCity = city;
				}
			}
			
			tempDistance = distance;
			
			if(distance>prevDistance*3){ 
				// Check if there is a closer city from cities already passed.
				for(Point2D city:itinerary){ 
					if(closestCity.distance(city)<tempDistance){
						tempDistance = closestCity.distance(city);
						closestCity2 = city; 
					}
				}
			}
			
			if(tempDistance<distance){ //If there is a closer city
				
				int indexClosestCity2 = itinerary.indexOf(closestCity2);
				Point2D prevCity = itinerary.get(itinerary.size()-1);
				
				if( (indexClosestCity2<itinerary.size()-1 && indexClosestCity2>0) && (distance)>(closestCity.distance(closestCity2) + closestCity.distance(itinerary.get(indexClosestCity2-1)))  &&
				(distance)>(closestCity.distance(closestCity2) + closestCity.distance(itinerary.get(indexClosestCity2+1)))	){
										
					if( (closestCity.distance(closestCity2) + closestCity.distance(itinerary.get(indexClosestCity2-1))) > 
					(closestCity.distance(closestCity2) + closestCity.distance(itinerary.get(indexClosestCity2+1))) ){
						
						itinerary.add(indexClosestCity2+1,closestCity); //add closest city
						cities.remove(closestCity); //remove start point from cities
						
					}else if( (closestCity.distance(closestCity2) + closestCity.distance(itinerary.get(indexClosestCity2-1))) < 
					(closestCity.distance(closestCity2) + closestCity.distance(itinerary.get(indexClosestCity2+1))) ){
						
						itinerary.add(indexClosestCity2+0,closestCity); //add closest city
						cities.remove(closestCity); //remove start point from cities
						
						
					}else{
						itinerary.add(indexClosestCity2+0,closestCity); //add closest city
						cities.remove(closestCity); //remove start point from cities
					}
					
					
				}else{
					prevDistance = distance;
					itinerary.add(closestCity); //add closest city
					cities.remove(closestCity); //remove start point from cities
					currentCity = closestCity;
				}
				
			}else{
				prevDistance = distance;
				itinerary.add(closestCity); //add closest city
				cities.remove(closestCity); //remove start point from cities
				currentCity = closestCity;
			}
			
		}
		
		return itinerary;
	}
	

}
