
<?php 

    require_once("../../models/DataProvider.php");

    session_start();

    if (!isset($_SESSION["username"]) || $_SESSION["role"] != "client"){
        redirect("../../views/login.php",false);
    }

    $dsn = "mysql:host=localhost;dbname=db_bankmanagement;";
    $username = "root";
    $pw = "root";

    $db = new PDO($dsn,$username,$pw);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


    if($_GET["id"]){
        $id = $_GET["id"];

        $bringUserDataQuery = "select * from users join account on users.userId = account.userId join transactions on account.accountId = transactions.transactionId where users.userId = :userId";
        $bringUserAccounts = "select * from account where userId = :id";
        $fetchUserDataquery = "select * from users where userId = :UID";
        $stmt = $db->prepare($bringUserAccounts);
        $stmt2 = $db->prepare($bringUserDataQuery);
        $stmt3 = $db->prepare($fetchUserDataquery);

        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt2->bindParam(":userId",$id,PDO::PARAM_INT);
        $stmt3->bindParam("UID",$id,PDO::PARAM_INT);
        try{
            $stmt->execute();
            $stmt2->execute();
            $stmt3->execute();
            $accountsOfUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $transactionsOfAccount = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $accountDetails = $stmt3->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die("invalid query" . $e->getMessage());
        }
}

?>

<!-- HEAD -->

<?php include("head.php"); ?>

<body class="flex h-[100vh]">

    <!-- SIDEBAR -->

    <?php include("sidebar.php"); ?>

    <!-- MAIN CONTENT -->

    <section class="w-[82.5%] h-full bg-gray-100">

        <!-- NAVBAR -->

        <?php include("navbar.php"); ?>

        <!-- CARDS -->

        <section class="h-[90%] py-2 px-8">
            
        <!-- DETAILS -->

            <div class="flex h-[30%] flex justify-evenly">
                <div class="w-[25%] bg-white rounded-2xl text-black flex">
                    <div class="w-24 bg-white flex justify-center border-black border-4 rounded-l-lg items-center">
                        <h2 class="text-4xl font-bold rotate-[-90deg]">Details</h2>
                    </div>
                    <div class="h-full w-[80%] bg-black text-white p-[1.5rem] grid grid-cols-2 rounded-r-lg">
                        <p class="font-extrabold">ID:</p><p><?=$accountDetails['userId']?></p>
                        <p class="font-extrabold">Date:</p><p>22/12/2000</p>
                        <p class="font-extrabold">Nationalite:</p><p>Deutsch</p>
                        <p class="font-extrabold">Genre:</p><p><?=$accountDetails['gendre']?></p>
                    </div>
                </div>

                <div class="w-[30%] h-[75%]">
                    <div class="h-[30%] bg-black flex justify-center border-black border-4 rounded-t-md items-center text-white">
                        <h2 class="text-4xl font-bold">Add Transfer</h2>
                    </div>
                    <form class="flex flex-col h-[90%] justify-evenly bg-white border-black border-4 rounded-b-md" method="post" action="transferes.php">
                        <div class="flex justify-evenly items-center h-10">
                            <label for="montant">Montant: </label>
                            <input class="bg-gray-200 w-[60%]" type="text" name="montant">
                        </div>
                        <div class="flex justify-evenly items-center h-10">
                            <label for="montant">Compte: </label>
                            <select class="bg-gray-200 w-[60%]" name="Compte">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <input class="h-10 w-20 mx-auto bg-green-500 text-white rounded" type="submit" value="Submit">
                    </form>
                </div>
            </div>

            <div class="flex justify-between h-[40%]">
                <div class="w-[34%] bg-white rounded-2xl text-black mt-20 flex border-black border-4">
                    <div class="w-24 bg-black flex justify-center border-black border-4 rounded-l-lg items-center text-white">
                        <h2 class="text-4xl font-bold rotate-[-90deg]">Comptes</h2>
                    </div>
                    <div class="h-full w-[80%] bg-white text-black p-[1.5rem] rounded-r-lg m-auto">
                        <table class="w-full">
                            <thead class="bg-black text-white">
                                <tr class="">
                                    <th class="border-black border-2">ID</th>
                                    <th class="border-black border-2">Balance</th>
                                    <th class="border-black border-2">Devise</th>
                                    <th class="border-black border-2">RIB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($accountsOfUser as $account): ?>
                                    <tr>
                                        <td class="border-black border-2"><?=$account['accountId']?></td>
                                        <td class="border-black border-2"><?=$account['balance']?></td>
                                        <td class="border-black border-2">EUR</td>
                                        <td class="border-black border-2"><?=$account['RIB']?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-[30%] bg-white rounded-2xl text-black mt-20 flex border-black border-4">
                    <div class="w-24 bg-black flex justify-center border-black border-4 rounded-l-lg items-center text-white">
                        <h2 class="text-4xl font-bold rotate-[-90deg]">Transactions</h2>
                    </div>
                    <div class="h-full w-[80%] bg-white text-black p-[1.5rem] rounded-r-lg m-auto">
                        <table class="w-full">
                            <thead class="bg-black text-white">
                                <tr class="">
                                    <th class="border-black border-2">ID</th>
                                    <th class="border-black border-2">Montant</th>
                                    <th class="border-black border-2">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($transactionsOfAccount as $transaction): ?>
                                    <tr>
                                        <td class="border-black border-2"><?=$transaction['transactionId']?></td>
                                        <td class="border-black border-2"><?=$transaction['amount']?></td>
                                        <td class="border-black border-2"><?=$transaction['type']?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-[30%] bg-white rounded-2xl text-black mt-20 flex border-black border-4">
                    <div class="w-24 bg-black flex justify-center border-black border-4 rounded-l-lg items-center text-white">
                        <h2 class="text-4xl font-bold rotate-[-90deg]">Transferes</h2>
                    </div>
                    <div class="h-full w-[80%] bg-white text-black p-[1.5rem] rounded-r-lg m-auto">
                        <table class="w-full">
                            <thead class="bg-black text-white">
                                <tr class="">
                                    <th class="border-black border-2">ID</th>
                                    <th class="border-black border-2">Montant</th>
                                    <th class="border-black border-2">Compte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-black border-2">99400242</td>
                                    <td class="border-black border-2">100000</td>
                                    <td class="border-black border-2">34234242</td>
                                </tr>
                                <tr>
                                    <td class="border-black border-2">99400242</td>
                                    <td class="border-black border-2">100000</td>
                                    <td class="border-black border-2">34234242</td>
                                </tr>
                                <tr>
                                    <td class="border-black border-2">99400242</td>
                                    <td class="border-black border-2">100000</td>
                                    <td class="border-black border-2">34234242</td>
                                </tr>
                                <tr>
                                    <td class="border-black border-2">99400242</td>
                                    <td class="border-black border-2">100000</td>
                                    <td class="border-black border-2">34234242</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </section>
</body>
</html>