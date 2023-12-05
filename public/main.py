import pandas as pd
import numpy as np
import re
import sys
import datetime

def openflat(namafile):
	with open(namafile, "r") as f:
		datamentah = []
		datatable = []
		newIndex = 0
		noMerchant = 0
		for i, line in enumerate(f):
			line = line.rstrip()
			if len(line) > 0 and line[0] == "1": newIndex = i

			if i>=newIndex and i<=newIndex+9:
				data = re.split(r'\s{2,}', line)
				if i==newIndex+1: 
					noMerchant = data[0]
					x = noMerchant.split()
					noMerchant = x[0]
				if i==newIndex+2:
					namaMerchant = data[0]
				if i==newIndex+4:
					alamatMerchant_1 = " ".join(data[:-1])
					accountNumber = data[-1]
				if i==newIndex+5:
					alamatMerchant_2 = " ".join(data[:-1])
				if i==newIndex+6:
					alamatMerchant_3 = " ".join(data)
				if i==newIndex+8:
					procDate = data[0]
					y = procDate.split()
					procDate = y[3]
					procDate = datetime.datetime.strptime(procDate,'%d/%m/%y').strftime('%Y-%m-%d')

					
			else:
				data = re.split(r'\s{1,}', line)
				if len(data)==11:
					data.insert(1, "")
					
			
			
			
			datamentah.append(data)
			if len(data)==12 and len(line)>81 and data[2]!="BATCH":
				alamatMerchant = alamatMerchant_1 + alamatMerchant_2 + alamatMerchant_3

				if(data[1] == ""):
					oo_batch = data[2]
					batch = data[3]
					seqnum = data[4]
					types = data[5]
					txn_date = data[6]
					txn_date = datetime.datetime.strptime(txn_date,'%d/%m/%y').strftime('%Y-%m-%d')
					auth = data[7]
					cardnum = data[8].replace("-", "")
					amount = data[9].replace(",", "")
					rate = data[10]
					disc_amount = data[11].replace(",", "")
				else:
					oo_batch = data[1]
					batch = data[2]
					seqnum = data[3]
					types = data[4]
					txn_date = data[5]
					txn_date = datetime.datetime.strptime(txn_date,'%d/%m/%y').strftime('%Y-%m-%d')
					auth = data[6]
					cardnum = data[7].replace("-", "")
					amount = data[8].replace(",", "")
					rate = data[9]
					disc_amount = data[11].replace(",", "")

				if(amount[-1] == "-"):
					amount = amount.replace("-", "")
					amount = "-" + amount
				else:
					amount = amount

				if(disc_amount[-1] == "-"):
					disc_amount = disc_amount.replace("-", "")
					disc_amount = "-" + disc_amount
				else:
					disc_amount = disc_amount

				array = [oo_batch, batch, seqnum, types, txn_date, auth, cardnum, amount, rate, disc_amount, noMerchant, namaMerchant, alamatMerchant, accountNumber, procDate]
				datatable.append(array)
		return pd.DataFrame(datatable)

if __name__ == '__main__':
	df = openflat("D:/xampp/htdocs/bnd_ui/public/Import/folder_" + sys.argv[1] + "/bnd350ui_" + sys.argv[1] + ".txt")
	df.columns = ["OO BATCH","BATCH","SEQ","TYPE","TXN-DATE","AUTH","CARD NUMBER","AMOUNT","RATE","DISC.AMT","noMerchant","namaMerchant","alamatMerchant","accountNumber","procDate"]

	df.to_excel("D:/xampp/htdocs/bnd_ui/public/Output_Python/hasil_bnd350ui_" + sys.argv[1] + ".xlsx", index=False)