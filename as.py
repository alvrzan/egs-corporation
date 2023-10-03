from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import accuracy_score
import pandas as pd
import mysql.connector

# Fungsi untuk melakukan klasifikasi Naive Bayes
def performNaiveBayes(dataset):
    # Drop baris dengan nilai NaN
    dataset = dataset.dropna()

    # Tetapkan ambang batas untuk menentukan label "efektif" dan "tidak efektif"
    threshold = 3.5

    # Tambahkan kolom label "efektif" dan "tidak efektif" berdasarkan nilai rata-rata
    kolom_nilai = ['A_P1', 'A_P2', 'B_P3', 'B_P4', 'B_P5', 'B_P6', 'C_P7', 'C_P8', 'C_P9', 'C_P10',
                   'C_P11', 'C_P12', 'C_P13', 'C_P14', 'D_P15', 'D_P16', 'D_P17']
    dataset['Label_Efektif'] = dataset[kolom_nilai].mean(axis=1) >= threshold

    # Konversi kolom Label_Efektif menjadi tipe data integer (1 untuk efektif, 0 untuk tidak efektif)
    dataset['Label_Efektif'] = dataset['Label_Efektif'].astype(int)

    # Bagi dataset menjadi data latih dan data uji
    X = dataset[kolom_nilai]
    y = dataset['Label_Efektif']

    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Inisialisasi model Naive Bayes
    model = GaussianNB()

    # Latih model pada data latih
    model.fit(X_train, y_train)

    # Lakukan prediksi pada data uji
    y_pred = model.predict(X_test)

    # Evaluasi model
    acc = accuracy_score(y_test, y_pred)

    # Tampilkan nilai akurasi
    print(f'Akurasi: {acc:.2f}')

    # Menambahkan kolom 'acc' ke dalam DataFrame
    dataset['acc'] = acc

    # Mengembalikan dataset yang telah diperbarui
    return dataset

if __name__ == '__main__':
    # Koneksi ke database MySQL
    connection = mysql.connector.connect(
        host='localhost',
        user='root',  # Ganti dengan username MySQL Anda
        password='',  # Ganti dengan password MySQL Anda
        database='ta'  # Ganti dengan nama database Anda
    )

    # Membaca data dari tabel MySQL dengan pernyataan SQL SELECT *
    query = "SELECT * FROM sistem_informasi"
    df = pd.read_sql(query, connection)

    # Memanggil fungsi performNaiveBayes
    result_df = performNaiveBayes(df)

    # Mengembalikan hasil dalam bentuk JSON
    result_json = result_df.to_json(orient='records')
    print(result_json)

    # Menutup koneksi ke database MySQL
    connection.close()
