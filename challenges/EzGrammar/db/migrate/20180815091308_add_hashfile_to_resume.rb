class AddHashfileToResume < ActiveRecord::Migration[5.2]
  def change
    add_column :resumes, :hashfile, :string
  end
end
