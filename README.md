# Portland Art Supply

Portland Art Supply (PAS) is an online shopping website for art supplies.  I created it to demonstrate what I learned in my HTML, CSS, JavaScript, PHP and Data Modeling and SQL courses.  This is a fully functional website except for the “checkout” process.  You can view products along with their description, color, size and price.  Products can be added to and deleted from the shopping cart and the quantity, sub- total and total purchase amounts will be adjusted accordingly.  If this was a “live” website, additional web pages would be added for the “checkout” process, to include shipping, and payment options.  Plus, a separate page for the staff at PAS would be included to allow users to add and delete products from the database.


View an ERD of the PAS database by first clicking on the “View Details” button under the “Projects” section of my portfolio site. Then click on the document icon to the right of “Data Modeling”.  
<br/>

**Code Highlights:**

Retrieve product information from database:  
Go to includes/db_code.php lines 95 - 108     

Generate HTML using PHP to create a dynamic web page that displays items in the user’s shopping cart:  
Go to includes/ui_code.php lines 194-243

Generate dynamic drop-down list for color and size options using JavaScript:  
Go to includes/pas.js.php lines 198-229  
<br/>

**Images:**  
Images are organized by category and subcategory folders.  
-	Category folders contain multiple subcategories  
-	Subcategory folders contain images of all products in that subcategory  
-	Three types of images  
     -	General product image  
     -	Specific product image for a particular color and size  
     -	Color thumbnail  
-	The category, sub category, group code, color, and size are stored in the database for each product.  The data is retrieved from the database and used to generate “src” attribute for each <img> tag. (see includes/ui_code.php lines 245 – 268)  
<br/> 

**Naming convention for the images:**

General product image:		&nbsp;&nbsp;&nbsp;&nbsp;group code.jpg 

Specific product image:		&nbsp;&nbsp;&nbsp;&nbsp;group code-color name-size description.jpg
	
Color thumbnail:		 &nbsp;&nbsp;&nbsp;&nbsp;group code-tn-color name.jpg

Note:  There will always be a “general product image”.  Some products will not have a “specific product image” or a “color thumbnail”.
<br/>

**Image Files and Folders Example:**

Category Folder: Paint  
&nbsp;&nbsp;&nbsp;&nbsp;Sub Category Folder:	 Oil    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             gamblin-1980-oils.jpg       &nbsp;&nbsp;&nbsp;&nbsp;                   <- group code   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             gamblin-1980-oils-burnt-sienna-37-ml.jpg    &nbsp;&nbsp;&nbsp;&nbsp;   <- group code-color name-size description   

&nbsp;&nbsp;&nbsp;&nbsp;     Sub Category Folder:	 Oil Color Thumbnails  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; gamblin-1980-oils-tn-burnt-sienna.jpg	 &nbsp;&nbsp;&nbsp;&nbsp; <- group code-tn-color name











