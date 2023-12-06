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
              <h3
                class="text-orange-600 text-3xl font-bold tracking-widest mb-2"
              >
                Users
              </h3>
              <p class="text-xl">Our Users around The world</p>
            </div>
            <div>
              <button
                class="bg-slate-900 text-white w-[160px] h-[50px] rounded-md"
                id="addBank"
              >
                Add User
              </button>
            </div>
          </div>
          <!-- ========== table Banks ======== -->
          <div class="rounded-lg overflow-hidden mt-10">
            <table class="w-full table-auto" id="table1">
              <thead class="">
                <tr class="bg-slate-900 text-white h-[60px]">
                  <th class="">ID</th>
                  <th class="">Username</th>
                  <th class="">Role</th>
                  <th class="">Email</th>

                  <th class="">Actions</th>
                </tr>
              </thead>
              <tbody>

              

              <?php 
              foreach($data_users as $duser) {
              ?>
                <tr class="h-[50px]">
               
                  <td class="text-center"><?php echo $duser->userId ?></td>
                  <td class="text-center"><?php echo $duser->username ?></td>
                  <td class="text-center"><?php echo $duser->roleName ?></td>
                  <td class="text-center"><?php echo $duser->email ?></td>
                  <td class="text-center">
                    <button
                      class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md"
                      
                    >
                    <a href="../../../app/views/users/updateUser.php?user_id=<?= $duser->userId;?>"> <i class="fa-solid fa-pen"></i></a>
                     

                    </button>
                    <button
                      class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md"
                    >
                    <a href="../../../app/views/users/deleteUser.php?user_id=<?= $duser->userId;?>"><i class="fa-solid fa-trash"></i></a>
                      
                    </button>

                    <button
                      class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md"
                    >
                    <a href="../../../app/views/users/UserAcc.php?user_id=<?= $duser->userId;?>"><i class="fa-solid fa-file"></i></a>
                      
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
            <form
              action=""
              method="post"

              class="absolute top-[50%] left-[20%] translate-y-[-50%] bg-white p-5 w-[1000px] rounded-md shadow-sm z-50 hidden"
              id="Add"
            >
              <h1 class="text-center font-semibold text-3xl my-5">
                Add new User
              </h1>
              <div class="flex gap-5">
                <div class="w-[50%]">
                  <label for="" class="text-xl">Username</label>
                  <input
                    type="text"
                    name="username"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Username "
                  />
                </div>
                <div class="w-[50%]">
                  <label for="" class="text-xl">Email</label>
                  <input
                    type="email"
                    name="email"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter email "
                  />
                </div>
              </div>

              <!-- gender -->
              <div class="flex gap-5">
                <div class="w-[50%]">
                  <label for="" class="text-xl">Gendre</label>
                  <select
                    name="gendre"
                    id="gendre"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  >
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>

                  </select>
                </div>
                <div class="w-[50%]">
                  <label for="" class="text-xl">Phone</label>
                  <input
                    type="tel"
                    name="phone"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Your Phone "
                  />
                </div>
              </div>
              <!-- phone -->

              <div class="flex gap-5">
                <div class="w-[50%]">
                  <label for="" class="text-xl">Password</label>
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter Password"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  />
                </div>
                <div class="w-[50%]">
                  <label for="" class="text-xl">Confirm Password</label>
                  <input
                    type="password"
                    name="newpassword"
                    placeholder="Confirm your Password"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  />
                </div>
              </div>
              <div class="flex gap-5">
                <div class="w-full">
                  <label for="" class="text-xl">Rue</label>
                  <input
                    type="text"
                    name="rue"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Rue "
                  />
                </div>
                <div class="w-full">
                  <label for="" class="text-xl">Ville</label>
                  <input
                    type="text"
                    name="ville"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Ville"
                  />
                </div>
              </div>
              <div class="w-full">
                <label for="" class="text-xl">Quartier</label>
                <input
                  type="text"
                  name="quartier"
                  class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  placeholder="Enter  Quartier "
                />
              </div>

              <div class="flex gap-4">
                <div class="w-[33%]">
                  <label for="" class="text-xl">Agency</label>
                  <select
                    name="agency"
                    id=""
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  >
                   
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
                  <label for="" class="text-xl">Role</label>
                  <select
                    name="role"
                    id=""
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  >
                    <option value="admin">Admin</option>
                    <option value="client">Client</option>

                  </select>
                </div>
                <div class="w-[33%]">
                  <label for="" class="text-xl">Code Postal</label>
                  <input
                    type="text"
                    name="postal"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Code postal "
                  />
                </div>
              </div>

              <div>
                <input
                  type="submit"
                  name="submit"
                  value="Envoyer"
                  class="block w-full py-3 text-white text-xl px-1 cursor-pointer mt-5 outline-none border-none bg-slate-900"
                />
              </div>
            </form>
          </div>
          <!-- ============ Form to add New Users ========= -->

          <!-- ============ Form to Update Users ========= -->

          <div>
            <form
              action=""
              method="get"
              class="absolute top-[50%] left-[20%] translate-y-[-50%] bg-white p-5 w-[1000px] rounded-md shadow-sm z-50 hidden"
              id="Edit"
            >
              <h1 class="text-center font-semibold text-3xl my-5">
                Update User

              </h1>
              <div class="flex gap-5">
                <div class="w-[50%]">
                  <label for="" class="text-xl">Username</label>
                  <input
                    type="text"
                    name="username"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Username "
                  />
                </div>
                <div class="w-[50%]">
                  <label for="" class="text-xl">Email</label>
                  <input
                    type="email"
                    name="email"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter email "
                  />
                </div>
              </div>
              <div class="flex gap-5">
                <div class="w-[50%]">
                  <label for="" class="text-xl">Gendre</label>
                  <select
                    name="gendre"
                    id="gendre"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  >
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="w-[50%]">
                  <label for="" class="text-xl">Phone</label>
                  <input
                    type="tel"
                    name="phone"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Your Phone "
                  />
                </div>
              </div>

              <div class="flex gap-5">
                <div class="w-[50%]">
                  <label for="" class="text-xl">Password</label>
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter Password"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  />
                </div>
                <div class="w-[50%]">
                  <label for="" class="text-xl">Confirm Password</label>
                  <input
                    type="password"
                    name="newpassword"
                    placeholder="Confirm your Password"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  />
                </div>
              </div>
              <div class="flex gap-5">
                <div class="w-full">
                  <label for="" class="text-xl">Rue</label>
                  <input
                    type="text"
                    name="rue"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Rue "
                  />
                </div>
                <div class="w-full">
                  <label for="" class="text-xl">Ville</label>
                  <input
                    type="text"
                    name="ville"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Ville"
                  />
                </div>
              </div>
              <div class="w-full">
                <label for="" class="text-xl">Quartier</label>
                <input
                  type="text"
                  name="quartier"
                  class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  placeholder="Enter  Quartier "
                />
              </div>

              <div class="flex gap-4">
                <div class="w-[33%]">
                  <label for="" class="text-xl">Agency</label>
                  <select
                    name="agency"
                    id=""
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  >
                    <option value="">Select Agency :</option>
                    <option value="Center Ville">Center Ville</option>
                  </select>
                </div>
                <div class="w-[33%]">
                  <label for="" class="text-xl">Role</label>
                  <select
                    name="role"
                    id=""
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                  >
                    <option value="">Select Role :</option>
                    <option value="Admin">Admin</option>
                  </select>
                </div>
                <div class="w-[33%]">
                  <label for="" class="text-xl">Code Postal</label>
                  <input
                    type="text"
                    name="postal"
                    class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                    placeholder="Enter Code postal "
                  />
                </div>
              </div>

              <div>
               
                   <button type="submit" name="edit" value="Edit" class="block w-full py-3 text-white text-xl px-1 cursor-pointer mt-5 outline-none border-none bg-slate-900"><a href="app/views/users/updateUser.php?user_id=">Edit</a></button>
    
              </div>
            </form>
          </div>
          <!-- ============ Form to Update Users ========= -->

        </div>
        <!-- ============ Content ============= -->
      </main>
      <!-- ========== overlay ================= -->
      <div
        class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden"
        id="overlayAdd"
      ></div>
      <div
        class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden"
        id="overlayEdit"
        onclick="updateForm()"
      ></div>
    </section>
    <script src="../../../public/assets/js/mainUser.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#table1').DataTable();
            });
        </script>

  </body>
</html>
