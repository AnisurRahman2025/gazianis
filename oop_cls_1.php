<?php 
/*
class কী?
class হলো একটি blueprint বা কাঠামো যার মাধ্যমে object তৈরি করা হয়।

class ডিক্লেয়ার করার নিয়ম:
class-এর প্রাথমিক সংজ্ঞা (definition) class keyword দিয়ে শুরু হয়, এরপর class-এর একটি নাম দেওয়া হয় তারপর কার্লি ব্রেস {} এবং এই কার্লি ব্রেস-এর মধ্যে ওই class-এর সকল property এবং method গুলো থাকে।

*/
class ClassName{
    public $property;
    public function myFunc(){
    
    }
}

/*
class-এর নাম দেওয়ার নিয়ম:
PHP-র যেকোনো বৈধ (valid) লেভেল দিয়ে class-এর নামকরণ করা যেতে পারে তবে PHP-র reserve keyword হতে পারবে না। একটি valid class-এর নামের প্রথম অক্ষর শুরু হয় letter অথবা underscore দিয়ে। এরপর যেকোনো সংখ্যক letter, number অথবা underscore হতে পারে। তবে PHP 8.4.0 ভার্সন থেকে class নামের প্রথম অক্ষর হিসেবে single underscore এর ব্যবহারকে deprecated ঘোষণা করা হয়েছে। Regular expression হিসেবে একে এভাবে প্রকাশ করা যায়:

^[a-zA-Z_\x80-\xff][a-zA-Z_0-9\x80-\xff]*$
এখানে \x80-\xff এর অর্থ হলো ১২৮ থেকে ২৫৫ পর্যন্ত যেকোনো অক্ষর বা byte value।

কোনো একটি class valid কিনা তা এই regular expression এর মাধ্যমে চেক করা যায়:
echo preg_match("/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/","MyName");

class-এর মধ্যে কী কী থাকে:
একটি class-এর মধ্যে class-এর নিজস্ব constant, property এবং method থাকে।

*/


//উদাহরণ: Simple class Definition

class SimpleClass{
    //property ঘোষণা
    public $var = 'a default value';
    //method ঘোষণা
    public function displayVar(){
        echo $this->var;
    }
}

$simpleclass = new SimpleClass;
$simpleclass->displayVar();

/*
pseudo variable $this কী:
একটি class-এর যখন object তৈরি করা হয় এবং সেই object context থেকে যখন ওই class-এর কোনো method-কে call করা হয় তখন সেই method-এর মধ্যে $this পাওয়া যায়। $this হলো calling object এর value।

*/
//$this একটি method এর মধ্যে available 

class A{
    public function foo(){
        if(isset($this)){
            echo '$this is defined (';
            echo get_class($this);
            echo ")";
        }else{
            echo '$this is not defined';
        }
    }
}

$a = new A;
$a->foo();

/*
PHP-তে $this একটি special variable, যা class-এর method এর ভিতরে ব্যবহার হয় এবং এটি ওই class-এর current object-কে নির্দেশ করে।

$this keyword শুধুমাত্র class-এর ভিতরের method-এ ব্যবহার করা যায়। এটি ওই class থেকে তৈরি হওয়া নির্দিষ্ট object কে নির্দেশ করে, যার মাধ্যমে আমরা সেই object-এর property এবং method-এ access করতে পারি।

$this কি object?
$this class method-এর মধ্যে object হিসাবেই কাজ করে।
তবে এটি সরাসরি object না, বরং reference to the current object — অর্থাৎ method চলাকালীন $this দিয়ে আমরা যেই object দিয়ে ওই method-টা call করেছিলাম, সেটা বোঝায়।

$this variable টি static method-এর ভিতরে ব্যবহার করা যাবে না। কারণ static method object ছাড়া call করা যায়।
*/

class B{
    public static function myFunc(){
        if(isset($this)){
            echo get_class($this); //Fatal error: Uncaught Error: Using $this when not in object context
        }else{
            echo '$this is not defined';
            var_dump($this);
        }
    }
}
$b = new B;
$b->myFunc();

/*
new keyword:
PHP OOP-এ new একটি কীওয়ার্ড, যা দিয়ে কোনো class-এর object তৈরি করা হয়।

new কী করে?
new keyword ব্যবহার করে যখন কোনো class কে call করা হয়, তখন সেই class-এর একটা নতুন instance বা object তৈরি হয়।

এই object দিয়ে সেই class-এর ভিতরের property এবং method গুলো access করা হয়।

*/

class C{
    public $foo;
    public function myFunc($val){
        return $this->foo = $val;
    }
}
$obj = new C; //new keyword দিয়ে C নামক class-কে call করার ফলে C নামক class-এর একটি object instance তৈরি হয়েছে।

//এখন এই object instance দিয়ে C নামক class-এর সকল property এবং method-এ access করা যাবে।

echo (new C)->myFunc("Hellow World"); //(new C) কে call করার ফলে C class-এর একটি object তৈরি হয়েছে যার ফলে এখন (new C) object দিয়ে C class-এর myFunc() method-এ call করা যাবে।

/*
class-এর object বা instance তৈরি-তে new keyword-এর ব্যবহার:
একটি class-এর instance তৈরি-তে new keyword অবশ্যই ব্যবহার করতে হবে। অর্থাৎ কোনো class-এর object instance তৈরি করতে হলে new keyword-এর সাথে class-এর নাম উল্লেখ করতে হয়। যেমন D নামক class-এর object instance তৈরি করতে হলে - new D আর E নামক class-এর object instance তৈরি করতে new E ।

আবার কোনো variable যদি class-এর নাম ধারণ করে তবে new এর সাথে সেই variable কে উল্লেখ করলে সেই class-এর একটি object instance তৈরি হবে।

উদাহরণ:

*/

class E{}
$a = "E";
new $a; //E class-এর object তৈরি হয়েছে।

/*
যদি class-এর constructor method-এ argument পাঠানোর দরকার হয় তবে new এর সাথে class-এর নাম দেওয়ার পর parenthesis দিতে হবে। আর যদি class-এর constructor method-এ argument পাঠানোর দরকার না হয় তবে parenthesis দেওয়ার প্রয়োজন নেই।

উদাহরণ:

*/



class F{
    public function __construct($v){
        echo $v; //Hellow From F Class
    }
}

$f = new F("Hellow From F Class");

/*
কোনো একটি object নির্দিষ্ট class-এর কিনা তা চেক করতে 'instanceof' operator ব্যবহার করা হয়। যদি নির্দিষ্ট class-এর হয় তবে true return করবে। object-টি নির্দিষ্ট class-এর না হলে false return করবে।

উদাহরণ:

*/



class G{}
$g = new G;
var_dump($g instanceof G); //bool(true)

/*
arbitrary expression ব্যবহার করে class-এর object instance তৈরি:
PHP 8.0.0 থেকে class-এর object instance তৈরিতে new এর সাথে arbitrary expression এর ব্যবহারকে support করা হয়। arbitrary expression class-এর নামকে উল্লেখ করে এবং এই ধরনের expression কে parenthesis-এর মধ্যে রাখতে হয়। function call করে, string concatenation করে, ::class constant ব্যবহার করে arbitrary expression তৈরি করা হয়।

উদাহরণ:

*/

class School {}

//string যোগ করে
var_dump(new ("Sch"."ool"));
echo "<br>";

//::class constant ব্যবহার করে
var_dump(new(School::class));
echo "<br>";

//function call করে
function mySchoolFunc(){
    return "School";
}
var_dump(new (mySchoolFunc()));
echo "<br>";

//একক expression এর সাহায্যে নতুন object তৈরি করে object-এর member-এ access করা যায়:

class I{
    public $iproperty;
    public function iFunction($i){
        return $this->iproperty = $i;
    }
}

echo (new I())->iFunction("This is iProperty value"); //This is iProperty value

/*
Property এবং Method:
class-এর property এবং method আলাদা namespace-এ সংরক্ষিত থাকে তাই একটি class-এ একই নামের property এবং method থাকতে পারে। নাম একই হলেও কোনটি property এবং কোনটি method তা ব্যবহারের ধরণ অনুযায়ী নির্ধারিত হয়। যদি $obj->something লিখি তবে সেটা property আর যদি $obj->something() লিখি তবে সেটা method।

উদাহরণ:

*/

class J{
    public $name = "name Property";
    public function name(){
        return "name method";
    }
}
$obj = new J;
echo $obj->name;
echo "<br>";
echo $obj->name();
echo "<br>";

/*
class-এর কোনো property-তে সরাসরি anonymous function-কে assign করা যায় না। class-এর property-তে anonymous assign করতে হলে প্রথমে সেই property-কে একটি variable-এ assign করতে হয়। এই ধরনের property-কে call করতে parenthesis দিয়ে ঘিরে নিতে হয়।

উদাহরণ:

*/

class K{
    public $bar;

    public function __construct(){
        $this->bar = function(){
            return 420;
        };
    }
}

echo ((new K)->bar)(); //420
echo "<br>";

$k = new K;
echo ($k->bar)(); //420

/*
Class inheritance-এ extends keyword এর ব্যবহার:
extends keyword এর মাধ্যমে একটি class অন্য একটি class-এর property, method এবং constant-এর উত্তরাধিকার পেতে পারে। তবে একাধিক class কে extends করা যায় না। একটি subclass-এর একটি মাত্র base class থাকবে।

parent class-এ যেই নামে constant, property এবং method থাকে child class-এও সেই একই নামে থাকতে পারে যাকে override বলা হয়। তবে parent class-এর কোনো constant এবং method-এর পূর্বে final ঘোষণা করা হলে সেগুলো child class-এ override করা যায় না।

parent:: ব্যবহার করে override করা method-এ parent method-এ access করা যায়।

উদাহরণ:

*/

class L{
    public function myFunc(){
        return " I am from Parent --myFunc()";
    }
}
class M extends L{
    public function myFunc(){
        echo "I am from Child --myFunc()";
        echo "<br>";
        echo parent::myFunc();
    }
}

$m = new M;
echo $m->myFunc();

/*
Method-এর Signature compatibility rules:
যখন কোনো method-কে child class-এ override করা হয় তখন parent method-এর signature-এর সাথে override করা child method-এর signature-এর মধ্যে সামঞ্জস্য বা compatibility থাকতে হবে।

signature-এর মধ্যে সামঞ্জস্য থাকবে যদি -
1. parent class-এর কোনো method-এর mandatory argument-কে child class-এ override করার সময় optional করা হয়।
2. নতুন parameter হিসেবে শুধুমাত্র optional parameter যোগ করা হয়।
3. method-এর visibility যদি বাড়ানো হয়, যেমন protected → public করা হয়।

তবে constructor এবং private method এই নিয়মের আওতায় পড়ে না।

Compatible child methods:

*/

class Base{
    public function foo(int $a){
        echo "Valid";
    }
}

class SubClass extends Base{
    public function foo(int $a=5){
        parent::foo($a);
    }
}
class OtherClass extends Base{
    public function foo(int $a = 5, $b=10){
        parent::foo($a);
    }
}

$subclass = new SubClass;
$subclass->foo();

$otherclass = new OtherClass;
$otherclass->foo();

/*
parameter-এর নাম child class-এ ভিন্ন হতে পারে তবে Named argument-এর ক্ষেত্রে parameter-এর নাম ভিন্ন হতে পারবে না।

উদাহরণ:

*/

class N{
    public function myFunc($foo, $bar){}
}
class O extends N{
    public function myFunc($foo, $bar){}
}
$o = new O;
//$o->myFunc(foo:"foo", bar:"bar");

/*
special constant ::class এর ব্যবহার:
::class হলো একটি special class constant যা কোনো একটি class-এর fully qualified class name কে নির্দেশ করে (FQCN)। আবার object টি কোন class-এর তা বের করতেও `::class` ব্যবহার করা হয়। তবে এটি runtime-এ ঘটে যা `get_class()` এর অনুরূপ।

উদাহরণ:

*/

class P{}
echo P::class; //P
echo "<br>";

class Q{}
$q = new Q;
echo $q::class; //Q

echo "<br><br>";

//class 16 er example

class Product {
    public string $name;
    public int $price;
    public string $category;
    public string $brand;
    public int $stock;
    public string $sku;

    public function __construct($name, $price, $category, $brand, $stock, $sku) {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->brand = $brand;
        $this->stock = $stock;
        $this->sku = $sku;
    }

    public function showDetails() {
        return "Name: {$this->name}<br> Price: {$this->price}<br> Category: {$this->category}<br> Brand: {$this->brand}<br> Stock: {$this->stock}<br> SKU: {$this->sku}";
    }
}

$product1 = new Product("Mobile", 2000, "Technology", "Walton", 50, "Tec001");
echo $product1->showDetails();
echo "<br><br>";


$product2 = new Product("Laptop", 25000, "Technology", "Dell", 2000, "Tec002");
echo $product2->showDetails();
echo "<br><br>";


class Person {
    public string $name;
    public int $age;
    public string $email;
    public string $phone;
    public string $address;
    public string $occupation;

    public function __construct($name, $age, $email, $phone, $address, $occupation) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->occupation = $occupation;
    }

    public function showProfile() {
        return "Name: {$this->name}<br> 
                Age: {$this->age}<br> 
                Email: {$this->email}<br> 
                Phone: {$this->phone}<br> 
                Address: {$this->address}<br> 
                Occupation: {$this->occupation}";
    }
}


$person = new Person(
    "Gazi",
    30,
    "gazi@outlook.com",
    "0173400000",
    "Gopalgonj",
    "Learner"
);

echo $person->showProfile();
 








































?>