<?php

require_once 'User.php'; 


class Admin{

    //product
    private $conn;
    private $table = 'products';
    public int $ProductID;
    public string $nameproduct;
    public string $price;
    public string $stock;
    public string $description;
    public string $image ;
    public string $error ='';
     // User
    public string $name;
    public string $email;
    public string $phone;
    public string $password;
    public string $user_type;
    public string $category ;
   
        public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getProducts() {
        if($_SERVER['REQUEST_METHOD']==='GET')
        {
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
}

public function addProducts()
 {
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $sql = "INSERT INTO products(nameproduct, price, stock, description,category)
                          VALUES (:name, :price, :stock, :description,:category)";
                  $stmt = $this->conn->prepare($sql);
                  $stmt->bindParam(':name', $this->nameproduct);
                  $stmt->bindParam(':price', $this->price);
                  $stmt->bindParam(':stock', $this->stock);
                  $stmt->bindParam(':description', $this->description);
                  $stmt->bindParam(':description', $this->image);
                $stmt->bindParam(':category', $this->category);
                  if ($stmt->execute()) {
                      return true;
                  } else {
                      $this->error = "Failed to add product.";
                      return false;
                  }

    }

}   
public function getProductById($id) {
    $sql = "SELECT * FROM products WHERE ProductID = :id";
    $stmt = $this->conn->prepare($sql);
     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "Fetching product with ID: $id<br>";

}

public function editProducts($id) {
    $sql = "UPDATE products 
            SET nameproduct = :name, 
                price = :price, 
                stock = :stock, 
                description = :description, 
                image = :image,
                category = :category
            WHERE ProductID = :id";                

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $this->nameproduct);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':stock', $this->stock);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        $this->error = "Failed to update product.";
        return false;
    }    
}    


public function deleteProducts()
 {
        if(!$this->ProductID) 
        {
        $this->error = "Product ID is missing.";
        return false;
        }
    $sql = "DELETE FROM products WHERE ProductID = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $this->ProductID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        $this->error = "Failed to delete product.";
        return false;
    }
 }

 public function getUsers() {
    $sql = "SELECT * FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function addUsers()
{
 if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $sql = "INSERT INTO users(name, email, phone,password ,user_type)
                          VALUES (:name, :email, :phone, :password,:user_type)";
                  $stmt = $this->conn->prepare($sql);
                  $stmt->bindParam(':name', $this->name);
                  $stmt->bindParam(':email', $this->email);
                  $stmt->bindParam(':phone', $this->phone);
                  $stmt->bindParam(':user_type', $this->user_type);
               $stmt->bindParam(':password', $this->password);
                  if ($stmt->execute()) {
                      return true;
                  } else {
                      $this->error = "Failed to add users.";
                      return false;
                  }

    }
}
public function getUserById($id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function editUsers($id)
{
 $sql = "UPDATE users 
            SET name = :name,
                email = :email,
                phone = :phone,
                user_type = :user_type
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':phone', $this->phone);
    $stmt->bindParam(':user_type', $this->user_type);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        $this->error = "Failed to update user.";
        return false;
    }
}
public function deleteUsers($id)
{
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        $this->error = "Failed to delete user.";
        return false;
    }
}
public function manageCategories() {}
public function viewReports() {

}

public function addAdmin() {}
public function deleteCustomerAccount() {}
public function verifySellerIdentity() {}
public function viewReportedProducts() {}
}
?>


