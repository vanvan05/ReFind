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

// Use case "Laporan Temuan Barang"
// function insert()
const insert = async (req,res) => {
  const { id, nama, lokasi, waktu, deskripsi, nama_foto } = req.body;
  try {
    const sql = `INSERT INTO findings (reporter_id, nama_barang, lokasi, waktu, deskripsi, foto_url) VALUES (?, ?, ?, ?, ?, ?)`;
    const result = await db.execute(sql, [id, nama, lokasi, waktu, deskripsi, nama_foto]);
    res.status(200).json({message: "Laporan berhasil dikirim"});
  } catch(error){
    res.status(409).json({error});
  }
}

// function update()
const update = async (req,res) => {
  const { nama, lokasi, waktu, deskripsi, nama_foto } = req.body;
  const { id } = req.params;
  try {
    const sql = `UPDATE findings SET nama_barang = ?, lokasi = ?, waktu = ?, deskripsi = ?, foto_url = ? WHERE finding_id = ?`;
    const result = await db.execute(sql, [nama, lokasi, waktu, deskripsi, nama_foto, id]);
    res.status(200).json({message: "Laporan berhasil diupdate"});
  } catch(error){
    res.status(409).json({error});
  }
}

// function getFinding()
const getFinding = async (req,res) => {
  const { id } = req.params;
  try {
    const sql = `SELECT findings.*, u.* FROM findings JOIN users u ON findings.reporter_id = u.user_id WHERE findings.finding_id = ?`;
    const [result] = await db.execute(sql, [id]);
    res.status(200).json(result[0]);
  } catch(error){
    res.status(409).json({error});
  }
}

// function getClaims()
const getClaim = async (req,res) => {
  const { id } = req.params;
  try {
    const sql = `SELECT claims.*, f.*, u.* FROM claims 
      JOIN findings f ON claims.item_id = f.finding_id 
      JOIN users u ON claims.claimer_id = u.user_id 
      WHERE claims.item_id = ?`;
    const [result] = await db.execute(sql, [id]);
    res.status(200).json(result[0]);
  } catch(error){
    res.status(409).json({error});
  }
}

// function getLatestFindings()
const getLatestFindings = async (req,res) => {
  try {
    const sql = `SELECT * FROM findings ORDER BY finding_id DESC LIMIT 3`;
    const [result] = await db.execute(sql);
    res.status(200).json(result);
  } catch(error){
    res.status(409).json({error});
  }
}

// function getFindingsByUser
const getFindingsByUser = async (req,res) => {
  const { id } = req.params;
  try {
    const sql = `SELECT * FROM findings WHERE reporter_id = ?`;
    const [result] = await db.execute(sql, [id]);
    res.status(200).json(result);
  } catch(error){
    res.status(409).json({error});
  }
}

// function delete()
const deleteFinding = async (req,res) => {
  const { id } = req.params;
  try {
    const sql = `DELETE FROM findings WHERE finding_id = ?`;
    const result = await db.execute(sql, [id]);
    res.status(200).json({message: "Laporan berhasil dihapus!"});
  } catch(error){
    res.status(409).json({error});
  }
}

// function deleteFoto()
const deleteFoto = async (req,res) => {
  const { id } = req.params;
  try {
    const sql = `UPDATE findings SET foto_url = NULL WHERE finding_id = ?`;
    const result = await db.execute(sql, [id]);
    res.status(200).json({message: "Foto berhasil dihapus!"});
  } catch(error){
    res.status(409).json({error});
  }
}

// End points use case "Laporan Temuan Barang"
router.post("/findings", insert);
router.put("/findings/:id", update);
router.get("/findings/:id", getFinding);
router.get("/findings/:id/claims", getClaim);
router.get("/findings", getLatestFindings);
router.get("/findings/users/:id", getFindingsByUser);
router.delete("/findings/:id", deleteFinding);
router.delete("/findings/:id/foto", deleteFoto);

// End points use case "Laporan Barang Hilang"
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
