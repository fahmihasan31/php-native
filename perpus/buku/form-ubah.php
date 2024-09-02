<?php
include '../config/layout.php';
include '../config/database.php';

include '../object/Buku.php';
include '../object/Kategori.php';
include '../object/Penerbit.php';

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

$kategori = new Kategori($db);
$penerbit = new Penerbit($db);

$dataKategori = $kategori->readAll();
$dataPenerbit = $penerbit->readAll();


$id = $_GET["ID"];
$buku->ID = $id;
$buku->readOne();
?>
<section class="bg-white dark:bg-gray-900">
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Buku Baru</h2>
            <form class="space-y-4" action="proses-ubah.php" method="POST">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2"">
                        <label for="isbn"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                        <input type="text" name="isbn" id="isbn" value="<?= $buku->ISBN ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan ISBN" required="">
                    </div>
                    <div class="sm:col-span-2"">
                        <label for="judul"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="judul" id="judul" value="<?= $buku->Judul ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Judul" required="">
                    </div>
                    <div class="sm:col-span-2"">
                        <label for="pengarang"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengarang</label>
                        <input id="pengarang" name="pengarang" rows="8" value="<?= $buku->Pengarang ?>"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Pengarang"></input>
                    </div>
                    <div class="w-full">
                        <label for="kategori"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <?php
                                while($row = $dataKategori->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);
                            ?>
                                    <option value="<?= $ID ?>"><?= $NamaKategori ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="penerbit"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                        <select id="penerbit_id" name="penerbit_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <?php
                                while($row = $dataPenerbit->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);
                            ?>
                                    <option value="<?= $ID ?>"><?= $NamaPenerbit ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="deskripsi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="8" 
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Deskripsi"><?= $buku->Deskripsi ?></textarea>
                    </div>
                    <div class="sm:col-span-2"">
                        <label for="stok"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input id="stok" name="stok" rows="8" value="<?= $buku->Stok ?>"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukkan Pengarang"></input>
                    </div>
                    <div>
                        <input type="text" name="id" id="id" style="display:none;" value="<?= $buku->ID ?>">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    <button type="button" onclick="history.back()"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg- gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>

</html>