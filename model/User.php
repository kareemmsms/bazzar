<?php

class User 
{
    
    private $conn;
        private string $table = 'users'; 
    public string $username;
    public int $id;
    public string $email;
    public string $message;

    public string $password;
    public string $phone;
    
    public string $error ='';


       public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getProductById($id) {
    $sql = "SELECT * FROM products WHERE ProductID = :id";
    $stmt = $this->conn->prepare($sql);
     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "Fetching product with ID: $id<br>";

}
    public function login() {
       
        require_once __DIR__ . '/../includes/Database.php';
        require_once __DIR__ . '/../includes/helpers.php';
        if(isLoggedIn())
        {
            header("Location: /bazaar/view/index.php");
          $_SESSION['logged_in'] = true;
          $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['timestamp'] = $user['timestamp'];
            $_SESSION['user_type'] = $user['user_type'];
       }
  $this->error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password']))
         {
            $_SESSION['logged_in'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['timestamp'] = $user['timestamp'];
            $_SESSION['user_type'] = $user['user_type'];

           if ($user['user_type'] === 'admin')
            {
            header("Location: /bazaar/view/admin.html"); 
            }  
            else 
            {
             header("Location: /bazaar/view/index.php"); 
            }
            exit;
        } else {
            
            $_SESSION['error'] = "Wrong password";
                    header("Location: /bazaar/view/login.php");
                    exit;
            // echo $error;
        }
    } else {
              $_SESSION['error'] = "Invalid email";
                header("Location: /bazaar/view/login.php");
                exit;
        // echo $error ;
        }
}
   

}
    public function register() {
    
        require_once __DIR__ . '/../includes/Database.php';
        require_once __DIR__ . '/../includes/helpers.php';
     $error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username =$_POST['username'];
    $email = $_POST['email'];
     $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // $token = bin2hex(random_bytes(16));
// Check if the password and confirm match
    if($password !== $confirm_password){
         $_SESSION['error'] = "password don't match";
        $error =  "Password do not match";
    } else {

        // check ig username already exists
        if(user_exists($this->conn, $username))
        {
             $_SESSION['error'] = "Username already exists, please choose another";
            $error = "Username already exists, Please choose another";
            // echo "your name already exist";4
            
            
        }
         if(email_exists($this->conn,$email))
         {
          $_SESSION['error'] = "email already exists, please choose another";
         }
         else {

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        //     $sql = "INSERT INTO users (name,phone,password, email) VALUES ('$username','$phone', '$passwordHash', '$email')";
        //    $stmt = $this->conn->prepare($sql);

        $sql = "INSERT INTO users (name, phone, password, email) 
        VALUES (:username, :phone, :password, :email)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
           ':username' => $username,
            ':phone' => $phone,
            ':password' => $passwordHash,
            ':email' => $email
             ]);


         echo "created successfully";   
            if($stmt->execute())
            {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header("Location: /bazaar/view/login.php");
                //     $link = "http://localhost/verify.php?token=$token";
                //    $subject = "Email Verification";
                //    $message = "Hi $username,\n\nClick to verify your email: $link";
                //    $headers = "From: karhamda@.com";

            //    mail($email, $subject, $message, $headers);
            //        echo "Registration successful. Please check your email to verify.";
                exit;
            }else {
                $_SESSION['error'] = "Registration failed. Please try again.";
                $error =  "SOMETHING HAPPENED not data inserted, error: " . mysqli_error($conn);
            };
            
            
        }

    }

}
}

// public function sendfeedback($conn) {
    
//      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
//         $username = trim($_POST["name"]);
//         $email = trim($_POST["email"]);
//         $message = trim($_POST["message"]);

//         // التحقق البسيط
//         if (!empty($username) && !empty($email) && !empty($message)) {
//             // إعداد الاستعلام
//             $sql = "INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)";
//             $stmt = $conn->prepare($sql);
//             $stmt->bindParam(':name', $username);
//             $stmt->bindParam(':email', $email);
//             $stmt->bindParam(':message', $message);

//             if ($stmt->execute()) {
//                 echo "<script>alert('Message sent successfully!');</script>";
//             } else {
//                 echo "<script>alert('Something went wrong.');</script>";
//             }
//         } else {
//             echo "<script>alert('Please fill in all fields.');</script>";
//         }
//     }
// }
public function updatePassword($userId, $newPassword){
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $query = "UPDATE {$this->table} SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        return $stmt->execute();
    }

public function sendFeedback() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST["name"] );
        $email = trim($_POST["email"] );
        $message = trim($_POST["message"]);

        if (!empty($username) && !empty($email) && !empty($message)) {
            $sql = "INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Message sent successfully!";
            } else {
                $_SESSION['error'] = "Something went wrong.";
            }
        } else {
            $_SESSION['error'] = "Please fill in all fields.";
        }

        header("Location: ../view/contact.php");
        exit;
    }
}
public function addItem() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        if (isset($_POST['cartID'], $_POST['productID'], $_POST['quantity'])) {
            $cartID = $_POST['cartID'];
            $productID = $_POST['productID'];
            $quantity = $_POST['quantity'];

            $sql = "INSERT INTO cartitem (cartID, productID, quantity)
                    VALUES (:cartID, :productID, :quantity)";
            $stmt = $this->conn->prepare($sql);

            if ($stmt->execute([
                ':cartID' => $cartID,
                ':productID' => $productID,
                ':quantity' => $quantity
            ])) {
                $_SESSION['success'] = "Product added to cart successfully.";
                header("Location: ../view/cart.php");
                exit;
            } else {
                $_SESSION['error'] = "Failed to add product to cart.";
                header("Location: ../view/products.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Missing product data.";
            header("Location: ../view/products.php");
            exit;
        }
    }
}
public function logout()
 { 
    session_start();
session_unset();           
session_destroy();        
header("Location: /bazaar/view/logout.php");
exit;
  }
}

?>