class CreateSecretttts < ActiveRecord::Migration[5.2]
  def change
    create_table :secretttts do |t|
      t.string :thinkoutoftheboxsmileicon

      t.timestamps
    end
  end
end
