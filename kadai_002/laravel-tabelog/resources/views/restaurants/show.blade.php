<div>
     <h2> Show Restaurant</h2>
 </div>
 <div>
     <a href="{{ route('restaurants.index') }}"> Back</a>
 </div>
 
 <div>
     <strong>Name:</strong>
     {{$restaurant->name}}
 </div>
 
 <div>
     <strong>Description:</strong>
     {{$restaurant->description}}
 </div>