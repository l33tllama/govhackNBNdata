import csv

command = "INSERT INTO data_volume_total_australia(Date, volume_dailup_tb, v\
olume_fixedline_tb, volume_wireless_tb, volume_broadband_tb, volume_total_tb\
, percent_dialup, percent_fixedline, percent_wireless, percent_broadband, pe\
rcent_total) VALUES ("

command = "INSERT INTO isps_per_state(Date, Tasmania, `Australian Capital Te\
rritory`, Victoria, `New South Wales`, `South Australia`, `Western Australia\
`, Queensland, `Northern Territory`) VALUES ("

command = "INSERT INTO net_users_by_connection_type(Date, `less_than_256k`, `\
256k_to_1.5m`, `1.5m_to_8m`, `8m_to_24m`, `greater_than_24m`) VALUES ("

command = "INSERT INTO households_with_net_by_state(state_id, total_households\
, `with`, without) VALUES("

csv_file = "../../Documents/households_with_net_by_state.csv"

values = ""
output = ""
with open(csv_file, "r") as csvfile:
    reader = csv.reader(csvfile, delimiter = ',', quotechar = '"')
    for row in reader:
        #row = row[0].split("\t")
        values = "'"
        i = 0
        for value in row:
            endline = "', '"
            if "," in value:
                loc = value.find(",")
                value = value[:loc] + value[loc + 1:]
            if i == len(row) - 1:
                endline = "'"
            values = values + value + endline
            i = i + 1
        output = output + command + values + ");\n"

output_file = open("insert_query.txt", "w")
output_file.write(output)
output_file.closed
