# Portland Art Supply

Portland Art Supply (PAS) is an e-commerce site for art supplies.  

Note: This is a demo site for a fictional company. A production version would include checkout (shipping + payment) and an admin interface for managing products. 

---

## Project Evolution & Modernization

This project began as a procedural PHP application that I built early in my development journey. I am actively modernizing the codebase to align with modern PHP standards and clean architecture practices.

My current refactoring goals:
- [x] Implemented PSR-4 autoloading
- [x] Introduced strict typing across the codebase
- [x] Refactored the cart to utilize `CartItem` objects instead of associative arrays
- [ ] Introduce a Router and Central Entry Point
- [ ] Create model classes
- [ ] Create repository classes

All refactoring is being done incrementally while preserving functionality. My goal is to migrate the site to a full MVC architecture. 

---

## Visit the site
[**▶ Live Demo**](https://portland-art-supply.bdtripp.com/)

---

## Demo

A quick walkthrough of browsing products, selecting options, and updating the shopping cart:

<img src="assets/pas_demo.gif" width="750" />

---

## UI Screenshots

<img src="assets/product_screenshot.png" width="750" />
<br>
<img src="assets/shopping_cart_screenshot.png" width="750" />

---

## Features
- View products by category, subcategory, and product group.
- View products along with their description, color and size options, and price.
- Add and delete products in the shopping cart and the quantity, sub-total, and total purchase amounts will be adjusted accordingly.
- Create an account to automatically save shopping cart history

---

## Technical Highlights

- Designed a nine‑table relational database for category, product, and user account data. 
- Implemented dynamic drop-down lists for product color and size options using multi-JOIN queries.
- Used AJAX to provide real-time updates to shopping cart quantities and totals.
- Stored PHP sessions in the database so the shopping cart is restored when the user logs in.

---

## Database Entity‑Relationship Diagram (ERD)

```mermaid
erDiagram
users {
    int user_id PK
    string username
    string password_hash
}

account_data {
    int user_id PK, FK
    string session_data
}

product_category {
    int category_id PK
    string category_name
}

product_subcategory {
    int subcategory_id PK
    int category_id FK
    string subcategory_name
}

product_manufacturer {
    int manufacturer_id PK
    string manufacturer_name
}

product_color {
    int color_id PK
    string color_name
}

product_size {
    int size_id PK
    string size_description
}

product_group {
    int product_group_id PK
    int category_id FK
    int subcategory_id FK
    int manufacturer_id FK
    string group_description
    string group_information
    string group_code
}

product_item {
    int product_item_id PK
    int product_group_id FK
    int color_id FK
    int size_id FK
    decimal price
}

%% Relationships
users ||--o| account_data : "has session"
product_category ||--o{ product_subcategory : "contains"
product_category ||--o{ product_group : "categorizes"
product_subcategory ||--o{ product_group : "sub-categorizes"
product_manufacturer ||--o{ product_group : "manufactures"
product_group ||--o{ product_item : "has variations"
product_color ||--o{ product_item : "applied to"
product_size ||--o{ product_item : "applied to"
```

---

## Tech Stack

- Languages: HTML5, CSS3, JavaScript, PHP
- Database: MySQL
- DevOps / Workflow: Docker, Dev Container, GitHub Actions

---

## Code Highlights

- **Database access**  
  The `lookup_items` function in [`includes/db_code.php`](includes/db_code.php) uses a multi-JOIN SQL query to retrieve all products within a particular product group from the database.

- **UI generation**  
  The `show_items_in_cart` function in [`includes/ui_code.php`](includes/ui_code.php) is responsible for dynamically generating the shopping cart interface.

- **Dynamic product options**  
  The `createDropDown` function in [`public/js/pas.js.php`](public/js/pas.js.php) generates the color and size dropdowns and updates the UI based on user selections.

---

## Images

**Folder Structure/Organization:**

Images are organized by category and subcategory folders.

- Category folders contain multiple subcategories
- Subcategory folders contain images of all products in that subcategory
- Three types of images
  - General product image
  - Specific product image for a particular color and size
  - Color thumbnail
- The category, subcategory, group code, color, and size are stored in the database for each product. The data is retrieved from the database and used to generate the `src` attribute for each `<img>` tag. (see `displayItemImage` function in [`includes/ui_code.php`](includes/ui_code.php))  

**Naming convention for the images:**

General product image: &nbsp;&nbsp;&nbsp;&nbsp;groupcode.jpg

Specific product image: &nbsp;&nbsp;&nbsp;&nbsp;groupcode-colorname-sizedescription.jpg

Color thumbnail: &nbsp;&nbsp;&nbsp;&nbsp;groupcode-tn-colorname.jpg

Note: There will always be a “general product image”. Some products will not have a “specific product image” or a “color thumbnail”.  

**Image Files and Folders Example:**

Category Folder: Paint  
&nbsp;&nbsp;&nbsp;&nbsp;Subcategory Folder: Oil  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; winsor-newton-artists-oil.jpg &nbsp;&nbsp;&nbsp;&nbsp; <- groupcode  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; winsor-newton-artists-oil-alizarin-crimson-37-ml-_-1_25-oz.jpg &nbsp;&nbsp;&nbsp;&nbsp; <- groupcode-colorname-sizedescription

&nbsp;&nbsp;&nbsp;&nbsp; Subcategory Folder: Oil Color Thumbnails  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; winsor-newton-artists-oil-tn-alizarin-crimson.jpg &nbsp;&nbsp;&nbsp;&nbsp; <- groupcode-tn-colorname






