<?php
require_once("../../models/user.php");
require_once("../../models/agency.php");
require_once './check.php';

$user = new Users();
$agencyy = new Agency();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  $username=$_POST['username'];
  $email=$_POST['email'];
  $gendre=$_POST['gendre'];
  $phone=$_POST['phone'];
  $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
  $rue=$_POST['rue'];
  $ville=$_POST['ville'];
  $quartier=$_POST['quartier'];
  $agency=$_POST['agency'];
  $role=$_POST['role'];
  $postal=$_POST['postal'];
  
  $user->addUser($username,$password,$gendre,$role,$ville,$quartier,$rue,$postal,$email,$phone,$agency);
    
  }

// ($username,$pw,$gendre,$role,$ville, $quartier,$rue,$codePostal,$email,$tel)
$agency_list=$agencyy->displayAgency();

$data_users=$user->displayUser();  

// print_r($agency_list);

?>





<?php include './aside.php'?>

<!-- ============ Content ============= -->
<div class="p-6 bg-white m-5">
    <div class="flex items-center justify-between">

        <div>
            <button class="bg-[#186F65] text-white w-[160px] h-[50px] rounded-md" id="addBank">
                Add User
            </button>
        </div>
    </div>
    <!-- ========== table Banks-desktop ======== -->
    <div class="hidden md:block  rounded-lg overflow-hidden mt-10">
        <table class=" 
           w-full   " id="table1">
            <thead class="  sm:w-full">
                <tr class="bg-[#186F65] text-white h-[60px]">
                    <th class="">ID</th>
                    <th class="">Username</th>
                    <th class="">Role</th>
                    <th class="">Email</th>

                    <th class="">Actions</th>
                </tr>
            </thead>
            <tbody class="sm:w-full">

                <?php 
              foreach($data_users as $duser) {
              ?>
                <tr class=" pt-10 sm:pt-0  w-full ">

                    <td class=" sm:text-center text-right">
                        <?php echo $duser->userId ?></td>
                    <td class=" sm:text-center text-right">
                        <?php echo $duser->username ?>
                    </td>
                    <td class=" sm:text-center text-right">
                        <?php echo $duser->roleName ?>
                    </td>
                    <td class=" sm:text-center 
                             text-right">
                        <?php echo $duser->email ?></td>
                    <td class="  sm:text-center  text-right">
                        <button class="bg-[#B5CB99] text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/users/updateUser.php?user_id=<?= $duser->userId;?>"> <i
                                    class="fa-solid fa-pen " style="color:#186F65"></i></a>


                        </button>
                        <button class="bg-[#B5CB99] text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/users/deleteUser.php?user_id=<?= $duser->userId;?>"><i
                                    class="fa-solid fa-trash " style="color:#186F65"></i></a>

                        </button>

                        <button class="bg-[#B5CB99] text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/users/UserAcc.php?user_id=<?= $duser->userId;?>"><i
                                    class="fa-solid fa-file" style="color:#186F65"></i></a>

                        </button>
                    </td>

                </tr>
                <?php 
              }
              ?>

            </tbody>
        </table>
    </div>
    <!-- ========== table Banks-mobile ======== -->
    <div class="block md:hidden rounded-lg overflow-hidden mt-10">
        <table class=" block w-full  border-2 sm:border-0  " id="table2">
            <thead class="hidden">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="block  w-full">
                <?php 
              foreach($data_users as $duser) {
              ?>
                <tr class="block pt-10 sm:pt-0   w-full ">

                    <td data-label="id"
                        class="border-b before:content-['id']  before:absolute before:left-0 before:w-1/2 before:font-bold before:text-left before:pl-2 sm:before:hidden sm:text-center block    text-right">
                        <?php echo $duser->userId ?></td>
                    <td data-label="username" class="border-b before:content-['username'] before:absolute before:left-0 before:w-1/2 before:font-bold before:text-left before:pl-2 block  sm:before:hidden sm:text-center 
                             text-right">
                        <?php echo $duser->username ?>
                    </td>
                    <td data-label="Role" class="border-b before:content-['Role'] before:absolute before:left-0 before:w-1/2 before:font-bold before:text-left before:pl-2 sm:before:hidden block  sm:text-center 
                            text-right">
                        <?php echo $duser->roleName ?>
                    </td>
                    <td data-label="Email" class="border-b before:content-['Email'] before:absolute before:left-0 before:w-1/2 before:font-bold before:text-left before:pl-2  sm:before:hidden block sm:text-center 
                             text-right">
                        <?php echo $duser->email ?></td>
                    <td data-label="ACtion"
                        class="border-b before:content-['action'] before:absolute before:left-0 before:w-1/2 before:font-bold before:text-left before:pl-2  sm:before:hidden  sm:text-center block    text-right">
                        <button class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/users/updateUser.php?user_id=<?= $duser->userId;?>"> <i
                                    class="fa-solid fa-pen"></i></a>

                        </button>
                        <button class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/users/deleteUser.php?user_id=<?= $duser->userId;?>"><i
                                    class="fa-solid fa-trash"></i></a>

                        </button>

                        <button class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md">
                            <a href="../../../app/views/users/UserAcc.php?user_id=<?= $duser->userId;?>"><i
                                    class="fa-solid fa-file"></i></a>

                        </button>
                    </td>

                </tr>
                <?php 
              }
              ?>

            </tbody>
        </table>
    </div>
    <!-- ============ Form to add New Users ========= -->
    <div>
        <form action="" method="post"
            class="absolute  -left-20 top-[50%] sm:left-[20%] translate-y-[-50%] bg-white p-5 w-[500px] sm:w-[1000px] rounded-md shadow-sm z-50 hidden"
            id="Add">
            <h1 class="text-center font-semibold text-3xl my-5">
                Add new User
            </h1>
            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-sm sm:text-xl">Username</label>
                    <input type="text" name="username"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Username " />
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-sm sm:text-xl">Email</label>
                    <input type="email" name="email"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter email " />
                </div>
            </div>

            <!-- gender -->
            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-sm sm:text-xl">Gendre</label>
                    <select name="gendre" id="gendre"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>

                    </select>
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-sm sm:text-xl">Phone</label>
                    <input type="tel" name="phone"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Your Phone " />
                </div>
            </div>
            <!-- phone -->

            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-sm sm:text-xl">Password</label>
                    <input type="password" name="password" placeholder="Enter Password"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100" />
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-sm sm:text-xl">Confirm Password</label>
                    <input type="password" name="newpassword" placeholder="Confirm your Password"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100" />
                </div>
            </div>
            <div class="flex gap-5">
                <div class="w-full">
                    <label for="" class="text-sm sm:text-xl">Rue</label>
                    <input type="text" name="rue"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Rue " />
                </div>
                <div class="w-full">
                    <label for="" class="text-sm sm:text-xl">Ville</label>
                    <input type="text" name="ville"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Ville" />
                </div>
            </div>
            <div class="w-full">
                <label for="" class="text-sm sm:text-xl">Quartier</label>
                <input type="text" name="quartier"
                    class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter  Quartier " />
            </div>

            <div class="flex gap-4">
                <div class="w-[33%]">
                    <label for="" class="text-sm sm:text-xl">Agency</label>
                    <select name="agency" id=""
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">

                        <?php 
                                            foreach($agency_list as $user) {
                                                echo "
                                                <option value='$user->agencyId'>$user->agencyId</option>
                                                ";
                                            }
                                        ?>
                    </select>
                </div>
                <div class="w-[33%]">
                    <label for="" class="text-sm sm:text-xl">Role</label>
                    <select name="role" id=""
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>

                    </select>
                </div>
                <div class="w-[33%]">
                    <label for="" class="text-sm sm:text-xl">Code Postal</label>
                    <input type="text" name="postal"
                        class="block w-full py-3 text-sm sm:text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Code postal " />
                </div>
            </div>

            <div>
                <input type="submit" name="submit" value="Envoyer"
                    class="block w-full py-3 text-white text-sm sm:text-xl px-1 cursor-pointer mt-5 outline-none border-none bg-slate-900" />
            </div>
        </form>
    </div>
    <!-- ============ Form to add New Users ========= -->

    <!-- ============ Form to Update Users ========= -->

    <div>
        <form action="" method="get"
            class="absolute top-[50%] left-[20%] translate-y-[-50%] bg-white p-5 w-[1000px] rounded-md shadow-sm z-50 hidden"
            id="Edit">
            <h1 class="text-center font-semibold text-3xl my-5">
                Update User

            </h1>
            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-xl">Username</label>
                    <input type="text" name="username"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Username " />
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
                    <label for="" class="text-xl">Gendre</label>
                    <select name="gendre" id="gendre"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-xl">Phone</label>
                    <input type="tel" name="phone"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Your Phone " />
                </div>
            </div>

            <div class="flex gap-5">
                <div class="w-[50%]">
                    <label for="" class="text-xl">Password</label>
                    <input type="password" name="password" placeholder="Enter Password"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100" />
                </div>
                <div class="w-[50%]">
                    <label for="" class="text-xl">Confirm Password</label>
                    <input type="password" name="newpassword" placeholder="Confirm your Password"
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
                <div class="w-[33%]">
                    <label for="" class="text-xl">Agency</label>
                    <select name="agency" id=""
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">
                        <option value="">Select Agency :</option>
                        <option value="Center Ville">Center Ville</option>
                    </select>
                </div>
                <div class="w-[33%]">
                    <label for="" class="text-xl">Role</label>
                    <select name="role" id=""
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100">
                        <option value="">Select Role :</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="w-[33%]">
                    <label for="" class="text-xl">Code Postal</label>
                    <input type="text" name="postal"
                        class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                        placeholder="Enter Code postal " />
                </div>
            </div>

            <div>

                <button type="submit" name="edit" value="Edit"
                    class="block w-full py-3 text-white text-xl px-1 cursor-pointer mt-5 outline-none border-none bg-slate-900"><a
                        href="app/views/users/updateUser.php?user_id=">Edit</a></button>

            </div>
        </form>
    </div>
    <!-- ============ Form to Update Users ========= -->

</div>
<!-- ============ Content ============= -->
</main>
<!-- ========== overlay ================= -->
<div class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden" id="overlayAdd"></div>
<div class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden" id="overlayEdit"
    onclick="updateForm()"></div>
</section>
<script src="../../../public/assets/js/mainUser.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('#table1').DataTable();

});
$(document).ready(function() {
    $('#table2').DataTable();

});
</script>

</body>

</html>