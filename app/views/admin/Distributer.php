
<?php

    require_once("../../controllers/distributer/controller.php");
    require_once './check.php';



?>

<?php include './aside.php'?>

                <!-- ============ Content ============= -->
                <div class="p-6 bg-white m-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3
                                class="text-orange-600 text-3xl font-bold tracking-widest mb-2"
                            >
                                Distributer
                            </h3>
                            <p class="text-xl">Our Banks around The world</p>
                        </div>
                        <div>
                            <button
                                class="bg-slate-900 text-white w-[160px] h-[50px] rounded-md"
                                id="addBank"
                            >
                                Add Distributer
                            </button>
                        </div>
                    </div>
                    <!-- ========== table Banks ======== -->
                    <div class="rounded-lg overflow-hidden mt-10">
                        <table class="w-full table-auto" id="table1">
                            <thead class="">
                                <tr class="bg-slate-900 text-white h-[60px]">
                                    <th class="">ID</th>
                                    <th class="">Longitude</th>
                                    <th class="">Latitude</th>
                                    <th class="">Address</th>
                                    <th class="">BankID</th>
                                    <th class="">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($distributers as $distributer): ?>
                                
                                    <tr class="h-[50px]">
                                        <td class="text-center"><?=$distributer['atmId']?></td>
                                        <td class="text-center"><?=$distributer['longitude']?></td>
                                        <td class="text-center"><?=$distributer['latitude']?></td>
                                        <td class="text-center"><?=$distributer['adress']?></td>
                                        <?php foreach($banks as $bank): ?>
                                            <?php if($bank->bankId == $distributer['bankId']){ ?>
                                                <td class="text-center"><?=$bank->name?></td>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                        <td class="text-center">
                                            <button
                                                class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md"
                                                onclick=""
                                            >
                                                <a href=<?php echo "Distributer.php?id=" . $distributer['atmId'] ?>><i class="fa-solid fa-pen"></i></a>
                                            </button>
                                            <button
                                                class="bg-slate-900 text-white w-[35px] h-[35px] rounded-md"
                                                id="addBank"
                                            >
                                            <a href=<?php echo "../../controllers/distributer/controller.php?bankId=" . $distributer['atmId'] ?>><i class="fa-solid fa-trash"></i></a>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- ============ Form to Add Distributer ========= -->
                    <div>
                        <form
                            action="../../controllers/distributer/controller.php"
                            method="post"
                            class="absolute top-[50%] left-[30%] translate-y-[-50%] bg-white p-5 w-[650px] rounded-md shadow-sm z-50 hidden"
                            id="Add"
                        >


                        <div class="w-full">
                            <label for="" class="text-xl">Address</label>
                            <input
                                type="text"
                                name="address"
                                class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                                placeholder="Enter Code postal "
                            />
                        </div>

                        <div class="w-full">
                            <label for="" class="text-xl">Longitude</label>
                            <input
                                type="text"
                                name="longitude"
                                class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                                placeholder="Enter Longitude"
                            />
                        </div>

                        <div class="w-full">
                            <label for="" class="text-xl">Latitude</label>
                            <input
                                type="text"
                                name="latitude"
                                class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                                placeholder="Enter Latitude"
                            />
                        </div>

                        <div class="w-full">
                            <label for="" class="text-xl">Bank</label>
                            <select
                                name="bank"
                                id=""
                                class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                            >
                                <?php foreach($banks as $bank): ?>
                                    <option value="<?=$bank->bankId?>"><?=$bank->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <input type="text" name="mode"  class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100 hidden" value="add" >
                            
                            <div>
                                <input
                                    type="submit"
                                    name="submit"
                                    class="block w-full py-3 text-white mt-5 text-xl px-1 cursor-pointer my-2 outline-none border-none bg-slate-900"
                                />
                            </div>
                        </form>
                    </div>
                    <!-- ============ Form to Edit Distributeur ========= -->
                    <div>
                        <?php if (isset($_GET['id'])) { ?>
                            <form
                                action="../../controllers/distributer/controller.php"
                                method="post"
                                class="absolute top-[50%] left-[30%] translate-y-[-50%] bg-white p-5 w-[650px] rounded-md shadow-sm z-50"
                                id="Edit"
                            >
                            
                            <?php foreach($distributers as $distributer): ?>
                                <?php if($distributer['atmId'] == $_GET['id']) { ?>
                                    <div class="w-full">
                                        <input
                                            type="text"
                                            name="id"
                                            class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100 hidden"
                                            value="<?=$distributer['atmId']?>"
                                        />
                                    </div>

                                    <div class="w-full">
                                        <label for="" class="text-xl">Address</label>
                                        <input
                                            type="text"
                                            name="address"
                                            class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                                            value="<?=$distributer['adress']?>"
                                        />
                                    </div>

                                    <div class="w-full">
                                        <label for="" class="text-xl">Longitude</label>
                                        <input
                                            type="text"
                                            name="longitude"
                                            class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                                            value="<?=$distributer['longitude']?>"
                                        />
                                    </div>

                                    <div class="w-full">
                                        <label for="" class="text-xl">Latitude</label>
                                        <input
                                            type="text"
                                            name="latitude"
                                            class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100"
                                            value="<?=$distributer['latitude']?>"
                                        />
                                    </div>

                                    <div class="w-full">
                                        <input
                                            type="text"
                                            name="bank"
                                            class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100 hidden"
                                            value="<?=$distributer['bankId']?>"
                                        />
                                    </div>

                                    <input type="text" name="mode"  class="block w-full py-3 text-xl px-1 placeholder:text-lg my-2 outline-none border-none bg-gray-100 hidden" value="edit" >
            
                                    <div>
                                        <input
                                            type="submit"
                                            name="submit"
                                            value="Edit"
                                            class="block w-full py-3 text-white mt-5 text-xl px-1 cursor-pointer my-2 outline-none border-none bg-slate-900"
                                        />
                                    </div>
                                <?php } ?>
                            <?php endforeach; ?>
                            </form>
                        <?php } ?>
                    </div>
                    <!-- ============ Form to add Transaction ========= -->
                </div>
                <!-- ============ Content ============= -->
            </main>
            <!-- ========== overlay ================= -->
            <div
                class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0 hidden"
                id="overlayAdd"
            ></div>
            <?php if (isset($_GET['id'])) { ?>
                <div
                    class="bg-black bg-opacity-60 w-full h-[100vh] absolute top-0 left-0"
                    id="overlayEdit"
                    onclick="updateForm()"
                ></div>
            <?php } ?>
        </section>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#table1').DataTable();
            });
        </script>
    </body>
</html>
