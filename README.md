# Command
Web Service to serve commandments and their translations for consumption in JSON data format.  For use by the Ten Commandments app.

This web service takes data from a database and exposes it a JSON object.

Going to the default page takes you to a page where you can :
 *  View the JSON string for all commandments
 *  View the JSON string for all translations
 *  View the JSON string for a number of the commandments [from -> to] by number

This web service uses CodeIgniter and its MVC pattern:
 *  Controller - The logic and the glue between the model and the view.  The controller methods define the public API (Endpoints) for this Web Service.
 *  Model - Governs access to the database.  In this web service data is pulled from the database, and not inserted.
 *  View - The views generate the JSON 
 
 This web service uses URI routing to make more human-friendly URLs for accessing each service.
 

