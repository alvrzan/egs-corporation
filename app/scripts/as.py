# as.py
# naive_bayes_model.py

from sklearn.naive_bayes import GaussianNB
import pandas as pd

class NaiveBayesModel:
    def __init__(self):
        self.model = GaussianNB()
        self.kolom_nilai = ['A-P1', 'A-P2', 'B-P3', 'B-P4', 'B-P5', 'B-P6', 'C-P7', 'C-P8', 'C-P9', 'C-P10',
                            'C-P11', 'C-P12', 'C-P13', 'C-P14', 'D-P15', 'D-P16', 'D-P17']

    def train_model(self, dataset_file):
        # Load dataset
        dataset = pd.read_excel(dataset_file)
        dataset = dataset.dropna()

        # Membulatkan kolom nilai
        dataset[self.kolom_nilai] = dataset[self.kolom_nilai].round(2)

        # Tetapkan ambang batas
        threshold = 3.3

        # Tambahkan kolom label
        dataset['Label_Efektif'] = dataset[self.kolom_nilai].mean(axis=1) >= threshold
        dataset['Label_Efektif'] = dataset['Label_Efektif'].astype(int)

        # Bagi dataset menjadi fitur dan label
        X = dataset[self.kolom_nilai]
        y = dataset['Label_Efektif']

        # Latih model
        self.model.fit(X, y)

    def predict(self, data):
        hasil_prediksi = self.model.predict(data)
        return hasil_prediksi
