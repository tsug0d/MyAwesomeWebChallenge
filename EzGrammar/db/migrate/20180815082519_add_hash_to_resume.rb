class AddHashToResume < ActiveRecord::Migration[5.2]
  def change
    add_column :resumes, :hash, :string
  end
end
