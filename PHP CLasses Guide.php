<?php

class User {
    protected $userID;
    protected $username;
    protected $email;
    protected $password;
    protected $birthday; // Changed from age to birthday
    protected $gender;
    protected $sex;
    protected $address;

    public function register() {}
    public function login() {}
    public function logout() {}
    public function updateProfile() {}
}

class Company {
    protected $name;
    protected $CEO;
    protected $brandIdentity;
    private $missionStatement;
    private $employees = [];
    private $resellers = [];
    private $branches = [];

    public function marketProducts() {}
    public function partnerWithResellers() {}
    public function brandProtection() {}
    
    // Website functionality merged here
    public function displayProducts() {}
    public function handleUserAuthentication() {}
    public function processOrder() {}

    public function addEmployee(Employee $employee) {
        $this->employees[] = $employee;
        $employee->setCompany($this);
    }

    public function addReseller(Reseller $reseller) {
        $this->resellers[] = $reseller;
    }

    public function addBranch(Branches $branch) {
        $this->branches[] = $branch;
    }
}

class Payment {
    protected $paymentID;
    protected $orderID;
    protected $amount;
    protected $paymentMethod;
    protected $paymentStatus;
    protected $transactionDate;
    protected $order;

    public function __construct() {
        $this->order = null;
    }

    public function processPayment() {}
    public function verifyPayment() {}
    public function refundPayment() {}
}

class ShoppingCart {
    private $cartID;
    private $productID;
    private $quantity;
    private $dateAdded;
    
    // Shipping info attributes merged into ShoppingCart
    private $shippingID;
    private $shippingType;
    private $shippingCost;
    private $shippingRegionID;

    public function addCartItem() {}
    public function updateQuantity() {}
    public function viewCartDetails() {}
    public function checkout() {}
    public function updateShippingInfo() {} // Merged from ShippingInfo
}

class Orders {
    protected $orderID;
    protected $productID;
    protected $subtotal;
    protected $payment;
    protected $orderDetails;
    protected $shoppingCart;
    protected $customer;

    public function __construct() {
        $this->payment = null;
        $this->orderDetails = null;
        $this->shoppingCart = null;
        $this->customer = null;
    }

    public function placeOrder() {}
}

class OrderDetails {
    protected $orderID;
    protected $productID;
    protected $productName;
    protected $subtotal;
    protected $unitCost;

    public function calculatePrice() {}
}

class Customer extends User {
    private $customerID;
    protected $purchaseHistory;
    protected $loyaltyStatus;
    protected $orders = [];
    protected $purchases = [];

    public function browse() {}
    public function purchase() {}
    public function verifyProduct() {}

    public function addOrder(Orders $order) {
        $this->orders[] = $order;
    }

    public function addPurchase(Purchases $purchase) {
        $this->purchases[] = $purchase;
    }
}

class Purchases {
    protected $purchaseHistory;
    protected $orderID;
    protected $productID;
    protected $productName;
    protected $unitTotal;
    protected $unitCost;

    public function viewHistory() {}
}

class Product {
    protected $productID;
    protected $productName;
    protected $serialNumber;
    protected $stockQuantity;
    protected $type;
    protected $unitCost;
    protected $orderDetails = [];
    protected $purchases = [];
    protected $shoppingCart = [];

    public function sell() {}
    public function getProductDetails() {}
    public function updateStock() {}
    public function applyDiscount() {}

    public function addToOrderDetails(OrderDetails $orderDetail) {
        $this->orderDetails[] = $orderDetail;
    }

    public function addToPurchases(Purchases $purchase) {
        $this->purchases[] = $purchase;
    }

    public function addToShoppingCart(ShoppingCart $cart) {
        $this->shoppingCart[] = $cart;
    }
}

class EmploymentRecord {
    protected $position;
    protected $startDate;
    protected $contractStatus;

    public function performance() {}
    public function modifyEmployeeData() {}
    public function createPerformanceReport() {}
}

class Employee extends User {
    private $employeeID;
    protected $position;
    protected $workSchedule;
    protected $performanceScore;
    protected $employmentRecord;
    protected $company;

    public function __construct() {
        $this->employmentRecord = null;
        $this->company = null;
    }

    public function manageOrders() {}
    public function manageInventory() {}
    public function helpCustomers() {}

    public function setEmploymentRecord(EmploymentRecord $record) {
        $this->employmentRecord = $record;
    }

    public function setCompany(Company $company) {
        $this->company = $company;
    }
}

class Branches {
    protected $name;
    protected $location;
    protected $company;
    protected $CEO;
    protected $brandIdentity;
    protected $missionStatement;

    public function setCompany(Company $company) {
        $this->company = $company;
    }
}

class Inventory {
    protected $stockLevel;
    private $employee;
    private $branches = [];
    private $resellers = [];

    public function __construct() {
        $this->employee = null;
    }

    public function notifyLowStock() {}
    public function monitorInventory() {}
    public function modifyInventoryLevels() {}
    public function inventoryReports() {}

    public function setEmployee(Employee $employee) {
        $this->employee = $employee;
    }

    public function addBranch(Branches $branch) {
        $this->branches[] = $branch;
    }

    public function addReseller(Reseller $reseller) {
        $this->resellers[] = $reseller;
    }
}

class Reseller extends User {
    private $resellerID;
    protected $businessName;
    protected $businessAddress;
    protected $contact;
    protected $performanceScore;
    protected $inventory;
    protected $company;

    public function __construct() {
        $this->inventory = null;
        $this->company = null;
    }

    public function sellProduct() {}
    public function manageInventory() {}

    public function setInventory(Inventory $inventory) {
        $this->inventory = $inventory;
        $inventory->addReseller($this);
    }

    public function setCompany(Company $company) {
        $this->company = $company;
    }
}
?>