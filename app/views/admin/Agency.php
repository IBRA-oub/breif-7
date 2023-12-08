<?php
require_once("../../models/agency.php");
require_once("../../models/bank.php");
require_once './check.php';


$agence = new Agency();
$bankk = new bank();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $longitude=$_POST['longitude'];
  $email=$_POST['email'];
  $latitude=$_POST['latitude'];
  $phone=$_POST['phone'];
  $rue=$_POST['rue'];
  $ville=$_POST['ville'];
  $quartier=$_POST['quartier'];
  $bank=$_POST['bank'];
  $postal=$_POST['postal'];
  

  $agence->addAgence($longitude,$latitude,$bank,$ville,$quartier,$rue,$postal,$email,$phone);
    
  }

// ($username,$pw,$gendre,$role,$ville, $quartier,$rue,$codePostal,$email,$tel)

$bankdata=$bankk->displayBank();

$data_agence=$agence->displayAgency();

// var_dump($data_agence);
// echo '<br>';
// var_dump($bankdata);


?>
<?php include './aside.php'?>

<!-- ========== End Header =========== -->
<!-- ============ Content ============= -->
<div class="p-6 bg-white m-5">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-orange-600 text-3xl font-bold tracking-widest mb-2">
                Agency
            </h3>
            <p class="text-xl">Our Banks around The world</p>
        </div>


        <?php if ($_SESSION["role"] === "admin") { ?>

        <div>
            <button class="bg-slate-900 text-white w-[160px] h-[50px] rounded-md" id="addBank">
                Add Agency
            </button>
        </div>

        <?php } ?>
    </div>
    <!-- ========== table Banks ======== -->
    <div class="rounded-lg overflow-hidden mt-10">
        <table class="w-full table-auto" id="table1">
            <thead class="">
                <tr class="bg-slate-900 text-white h-[60px]">
                    <th class="">AgencyID</th>
                    <th class="">Longitude</th>
                    <th class="">Latitude</th>
                    <th class="">BankID</th>
                    <?php if ($_SESSION["role"] === "admin") { ?>

                    <th class="">Actions</th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php 
              foreach($data_agence as $dagence) {
              ?>
                <tr class="h-[50px]">
                    <td class="text-center"><?php echo $dagence->agencyId ?></td>
                    <td class="text-center"><?php echo $dagence->longitude ?></td>
                    <td class="text-center"><?php echo $dagence->latitude ?></td>
                    <td class="text-center"><?php echo $dagence->name ?></td>

                    <?php if ($_SESSION["role"] === "admin") { ?>

                    <td class="text-center">
                        <button class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/agency/updateAgency.php?agence_id=<?= $dagence->agencyId;?>"> <i
                                    class="fa-solid fa-pen"></i></a>

                        </button>
                        <button class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md" id="addBank">
                            <a href="../../../app/views/agency/deleteAgency.php?agency_id=<?= $dagence->agencyId;?>"><i
                                    class="fa-solid fa-trash"></i></a>
                        </button>
                    </td>
                    <?php } ?>

                </tr>
                <?php 
              }
              ?>
            </tbody>
        </table>
    </div>
    <!-- ============ Form to Add Agency ========= -->
    <div>
        <form action="" method="post"
            class="absolute top-[50%] left-[20%] translate-y-[-50%] bg-white p-5 w-[1000px] rounded-md shadow-sm z-50 hidden"
            id="Add">
            <h1 class="text-center font-semibold text-3xl my-5">
                Add new Agency
            </h1>
            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-xl">Phone</label>
                    <input type="tel" name="phone"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Your Phone " />
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-xl">Email</label>
                    <input type="email" name="email"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter email " />
                </div>
            </div>


            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-xl">latitude</label>
                    <input type="text" name="latitude" placeholder="latitude"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100" />
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-xl">longitude</label>
                    <input type="text" name="longitude" placeholder="longitude"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100" />
                </div>
            </div>
            <div class="flex gap-5">
                <div class="w-full">
                    <label for="" class="text-xl">Rue</label>
                    <input type="text" name="rue"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Rue " />
                </div>
                <div class="w-full">
                    <label for="" class="text-xl">Ville</label>
                    <input type="text" name="ville"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Ville" />
                </div>
            </div>
            <div class="w-full">
                <label for="" class="text-xl">Quartier</label>
                <input type="text" name="quartier"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter  Quartier " />
            </div>

            <div class="flex gap-4">
                <div class="w-[50%]">
                    <label for="" class="text-xl">Bank</label>
                    <select name="bank" id=""
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">

                        <?php 
                                            foreach($bankdata as $data) {
                                                echo "
                                                <option value='$data->bankId'>$data->name</option>
                                                ";
                                            }
                                        ?>
                    </select>
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-xl">Code Postal</label>
                    <input type="text" name="postal"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Code postal " />
                </div>
            </div>

            <div>
                <input type="submit" name="submit"
                    class="block w-full py-3 text-white text-xl px-1 cursor-pointer mt-5 outline-none border-none bg-slate-900" />
            </div>
        </form>
    </div>
    <!-- ============ Form to add Agency ========= -->
    <!-- ============ Form to Edit Agency ========= -->
    <div>
        <form action="" method="get"
            class="absolute top-[50%] left-[30%] translate-y-[-50%] bg-white p-5 w-[650px] rounded-md shadow-sm z-50 hidden"
            id="Edit">
            <div>
                <label for="" class="text-xl">Latitude</label>
                <input type="text" name="amount"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Latitude..." />
            </div>
            <div>
                <label for="" class="text-xl">Logitude</label>
                <input type="text" name="amount"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Logitude..." />
            </div>
            <div>
                <input type="submit" name="submit" value="Edit"
                    class="block w-full py-3 text-white mt-5 text-xl px-1 cursor-pointer my-2 outline-none border-none bg-slate-900" />
            </div>
        </form>
    </div>
    <!-- ============ Form to add Transaction ========= -->
</div>
<!-- ============ Content ============= -->
</main>
<!-- ========== overlay ================= -->
<div class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden" id="overlayAdd"></div>
<div class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden" id="overlayEdit"
    onclick="updateForm()"></div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('#table1').DataTable();
});
</script>
</body>

</html>