const express = require('express');
const mysql = require('mysql2/promise');
const cors = require('cors');

const app = express();
const router = express.Router();
app.use(cors());
app.use(express.json());

const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'refind',
};
let db;
(async () => {
  db = await mysql.createPool(dbConfig);
})();

const createLaporan = async (req, res) => {
  try {
    const { nama_barang, deskripsi, last_seen, foto_url, reporter_id } = req.body;
    if (!nama_barang || !last_seen || !reporter_id) {
      return res.status(400).json({ message: 'nama_barang, last_seen, dan reporter_id wajib diisi' });
    }

    const sql = `
      INSERT INTO lost_items (nama_barang, deskripsi, last_seen, foto_url, reporter_id, is_found)
      VALUES (?, ?, ?, ?, ?, 0)`;
    const [result] = await db.execute(sql, [nama_barang, deskripsi, last_seen, foto_url || null, reporter_id]);
    res.status(201).json({ insertedId: result.insertId });
  } catch (err) {
    res.status(500).json({ message: 'Gagal menambah laporan', error: err.message });
  }
};

const getAllLaporan = async (req, res) => {
  try {
    const [rows] = await db.query(`SELECT * FROM lost_items ORDER BY lost_item_id DESC`);
    res.json(rows);
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengambil data', error: err.message });
  }
};

const getFoundItems = async (req, res) => {
  try {
    const [rows] = await db.query(`SELECT * FROM lost_items WHERE is_found = 1 ORDER BY lost_item_id DESC`);
    res.json(rows);
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengambil data', error: err.message });
  }
};

const getLaporanById = async (req, res) => {
  try {
    const { id } = req.params;
    const [rows] = await db.query(`SELECT * FROM lost_items WHERE lost_item_id = ?`, [id]);
    if (!rows.length) return res.status(404).json({ message: 'Laporan tidak ditemukan' });
    res.json(rows[0]);
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengambil data', error: err.message });
  }
};

const updateLaporan = async (req, res) => {
  try {
    const { id } = req.params;
    const { nama_barang, deskripsi, last_seen, foto_url, reporter_id, is_found } = req.body;
    if (!nama_barang || !last_seen || !reporter_id) {
      return res.status(400).json({ message: 'nama_barang, last_seen, dan reporter_id wajib' });
    }

    const sql = `
      UPDATE lost_items SET
        nama_barang = ?, deskripsi = ?, last_seen = ?, foto_url = ?, reporter_id = ?, is_found = ?
      WHERE lost_item_id = ?`;
    const [result] = await db.execute(sql, [
      nama_barang,
      deskripsi,
      last_seen,
      foto_url || null,
      reporter_id,
      is_found ?? 0,
      id
    ]);

    res.json({ updated: result.affectedRows > 0 });
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengupdate laporan', error: err.message });
  }
};

const deleteLaporan = async (req, res) => {
  try {
    const { id } = req.params;
    const [result] = await db.execute(`DELETE FROM lost_items WHERE lost_item_id = ?`, [id]);
    res.json({ deleted: result.affectedRows > 0 });
  } catch (err) {
    res.status(500).json({ message: 'Gagal menghapus laporan', error: err.message });
  }
};


router.post('/lapor', createLaporan);
router.get('/lapor', getAllLaporan);
router.get('/lapor/found', getFoundItems);
router.get('/lapor/:id', getLaporanById);
router.put('/lapor/:id', updateLaporan);
router.delete('/lapor/:id', deleteLaporan);

app.use('/api', router);

app.listen(3000, () => {
  console.log('API ReFind berjalan di http://localhost:3000/api/lapor');
});
